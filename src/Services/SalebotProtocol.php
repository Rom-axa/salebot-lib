<?php namespace professionalweb\salebot\Services;

use professionalweb\salebot\Interfaces\Models\Response;
use professionalweb\salebot\Models\Response as ResponseModel;
use professionalweb\salebot\Interfaces\Services\SalebotProtocol as ISalebotProtocol;

/**
 * Service-protocol
 * @package professionalweb\salebot\Services
 */
class SalebotProtocol implements ISalebotProtocol
{

    /** @var string */
    private $apiKey;

    public function __construct(string $apikey = '')
    {
        $this->setApiKey($apikey);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return SalebotProtocol
     */
    public function setApiKey(string $apiKey): SalebotProtocol
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Send request to API
     *
     * @param string $httpMethod
     * @param string $apiMethod
     * @param array  $params
     *
     * @return Response
     * @throws \Exception
     */
    public function send(string $httpMethod, string $apiMethod, array $params = []): Response
    {
        $httpMethod = mb_strtolower($httpMethod);
        $url = $this->getCommandUrl($apiMethod);
        if ($httpMethod === 'get') {
            $url .= strpos($url, '?') ? '&' : '?';
            $url .= http_build_query($params);
        }
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'PW.Sendsay.Lib/PHP');
//        if ($httpMethod === 'post') {
//            curl_setopt($curl, CURLOPT_POST, 1);
//            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
//        } else
        if ($httpMethod !== 'get') {
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($httpMethod));
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $body = curl_exec($curl);

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) >= 400) {
            return new ResponseModel(Response::STATUS_FAIL);
        }

        $payload = json_decode($body, true);
        if ($payload !== null) {
            return new ResponseModel(
                ($payload['status'] ?? Response::STATUS_SUCCESS),
                $payload
            );
        }
        if ($body === 'ok') {
            return new ResponseModel(Response::STATUS_SUCCESS);
        }

        return new ResponseModel(Response::STATUS_FAIL);
    }

    /**
     * Create url for request
     *
     * @param string $method
     *
     * @return string
     * @throws \Exception
     */
    protected function getCommandUrl(string $method): string
    {
        $apiKey = $this->getApiKey();
        if (empty($apiKey)) {
            throw new \Exception('API key needed');
        }

        return 'https://chatter.salebot.pro/api/' . $apiKey . '/' . $method;
    }
}