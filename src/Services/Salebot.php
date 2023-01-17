<?php

declare(strict_types=1);

namespace Salebot\Services;

use Salebot\Interfaces\Models\Button;
use Salebot\Interfaces\Models\Client;
use Salebot\Interfaces\Models\Message;
use Salebot\Interfaces\Models\Attachment;
use Salebot\Interfaces\Services\ClientInterface;
use Salebot\Interfaces\Services\ProtocolInterface;
use Salebot\Models\Message as MessageModel;

class Salebot implements ClientInterface
{
    public const METHOD_CALLBACK = 'callback';
    public const METHOD_VK_CALLBACK = 'vk_callback';
    public const METHOD_WHATSAPP_CALLBACK = 'whatsapp_callback';
    public const METHOD_OK_CALLBACK = 'ok_callback';
    public const METHOD_TELEGRAM_CALLBACK = 'tg_callback';
    public const METHOD_MESSAGE = 'message';
    public const METHOD_MESSAGE_BROADCAST = 'broadcast';
    public const METHOD_MESSAGE_WHATSAPP = 'whatsapp_message';
    public const METHOD_SAVE_VARIABLES = 'save_variables';
    public const METHOD_GET_VARIABLES = 'get_variables';
    public const METHOD_GET_CLIENTS = 'get_clients';
    public const METHOD_GET_HISTORY = 'get_history';
    public const METHOD_CLEAR_HISTORY = 'clear_history';
    public const METHOD_GET_CHANNELS = 'connected_channels';
    public const METHOD_CLIENT_ID_BY_CHAT = 'online_chat_client_id';
    public const METHOD_UPLOAD_CLIENTS = 'load_clients';
    public const METHOD_WHATSAPP_CLIENT_ID = 'whatsapp_client_id';
    public const METHOD_CLIENT_ID_BY_PHONE = 'find_client_id_by_phone';
    public const METHOD_CLIENT_ID_BY_EMAIL = 'find_client_id_by_email';
    public const METHOD_CLIENT_ID_BY_VAR = 'find_client_id_by_var';
    public const METHOD_VK_SUBSCRIBERS = 'vk_subscribers';
    public const METHOD_CHECK_INSTAGRAM_SUBSCRIPTION = 'check_insta_subscription';
    public const METHOD_CHECK_WHATSAPP = 'check_whatsapp';
    public const METHOD_MESSAGES = 'get_messages';

    /** @var ProtocolInterface */
    private $protocol;

    public function __construct(ProtocolInterface $protocol)
    {
        $this->setProtocol($protocol);
    }

    /**
     * @return ProtocolInterface
     */
    public function getProtocol(): ProtocolInterface
    {
        return $this->protocol;
    }

    /**
     * @param ProtocolInterface $protocol
     *
     * @return Salebot
     */
    public function setProtocol(ProtocolInterface $protocol): Salebot
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function callback(string $message, string $phone = '', string $email = '', string $id = '')
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_CALLBACK, [
            'client_phone' => $phone,
            'client_email' => $email,
            'client_id'    => $id,
            'message'      => $message,
        ]);

        return $result;
    }

    public function vkCallback(string $groupId, string $userId, string $message = '')
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_VK_CALLBACK, [
            'user_id'  => $userId,
            'group_id' => $groupId,
            'message'  => $message,
        ]);

        return $result;
    }

    public function whatsappCallback(string $phone, string $name = '', string $message = '', string $botId = '')
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_WHATSAPP_CALLBACK, [
            'name'    => $name,
            'message' => $message,
            'phone'   => $phone,
            'bot_id'  => $botId,
        ]);

        return $result;
    }

    public function okCallback(string $groupId, string $userId, string $message)
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_OK_CALLBACK, [
            'user_id'  => $userId,
            'group_id' => $groupId,
            'message'  => $message,
        ]);

        return $result;
    }

    public function tgCallback(string $groupId, string $userId, string $message)
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_TELEGRAM_CALLBACK, [
            'user_id'  => $userId,
            'group_id' => $groupId,
            'message'  => $message,
        ]);

        return $result;
    }

    public function sendMessage(string $clientId, string $message = '', string $messageId = '', ?Attachment $attachment = null, array $buttons = [])
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_MESSAGE, [
            'message_id'      => $messageId,
            'message'         => $message,
            'client_id'       => $clientId,
            'attachment_type' => $attachment !== null ? $attachment->getType() : null,
            'attachment_url'  => $attachment !== null ? $attachment->getUrl() : null,
            'buttons'         => array_map(function (Button $button) {
                return $button->toArray();
            }, $buttons),
        ]);

        return $result;
    }

    public function broadcast(array $clientIds = [], string $message = '', string $messageId = '', string $list = '', float $shift = 0.2, ?Attachment $attachment = null, array $buttons = [])
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_MESSAGE_BROADCAST, [
            'message_id'      => $messageId,
            'list'            => $list,
            'shift'           => $shift,
            'message'         => $message,
            'clients'         => $clientIds,
            'attachment_type' => $attachment !== null ? $attachment->getType() : null,
            'attachment_url'  => $attachment !== null ? $attachment->getUrl() : null,
            'buttons'         => array_map(function (Button $button) {
                return $button->toArray();
            }, $buttons),
        ]);

        return $result;
    }

    public function whatsappMessage(string $phone, string $message = '', string $messageId = '', string $whatsappBotId = '', ?Attachment $attachment = null)
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_MESSAGE_WHATSAPP, [
            'message_id'      => $messageId,
            'whatsapp_bot_id' => $whatsappBotId,
            'phone'           => $phone,
            'message'         => $message,
            'attachment_type' => $attachment !== null ? $attachment->getType() : null,
            'attachment_url'  => $attachment !== null ? $attachment->getUrl() : null,
        ]);

        return $result;
    }

    /**
     * Save variables to user
     *
     * @param string $clientId
     * @param array  $variables
     * @param array  $clientsId
     *
     * @return bool
     */
    public function saveVariables(string $clientId, array $variables, array $clientsId = []): bool
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_SAVE_VARIABLES, [
            'clients'   => $clientsId,
            'client_id' => $clientId,
            'variables' => $variables,
        ]);

        return $result->isSuccess();
    }

    public function getVariables(string $clientId)
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_GET_VARIABLES, [
            'client_id' => $clientId,
        ]);

        return $result;
    }

    public function getClients(?int $limit = null, ?int $offset = null)
    {
        $params = array_filter(compact('limit', 'offset'));
        $result = $this->getProtocol()->send('GET', self::METHOD_GET_CLIENTS, $params);

        return $result;
    }

    public function getHistory(string $clientId)
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_GET_HISTORY, [
            'client_id' => $clientId,
        ]);

        return $result;
    }

    public function clearHistory(string $clientId)
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_CLEAR_HISTORY, [
            'client_id' => $clientId,
        ]);

        return $result;
    }

    public function getConnectedChannels()
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_GET_CHANNELS);

        return $result;
    }

    public function getOnlineChatClientId(string $recipient, string $name = '', string $tag = '')
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_CLIENT_ID_BY_CHAT, [
            'tag'       => $tag,
            'name'      => $name,
            'recipient' => $recipient,
        ]);

        return $result;
    }

    public function uploadClients(array $clients)
    {
        $result = $this->getProtocol()->send('POST', self::METHOD_UPLOAD_CLIENTS, [
            'clients' => array_map(function (Client $client) {
                return $client->toArray();
            }, $clients),
        ]);

        return $result;
    }

    public function getClientIdByWhatsApp(string $phone)
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_WHATSAPP_CLIENT_ID, [
            'phone' => $phone,
        ]);

        return $result;
    }

    /**
     * Get client id by phone
     *
     * @param string $phone
     *
     * @return int|null
     */
    public function getClientIdByPhone(string $phone): ?int
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_CLIENT_ID_BY_PHONE, [
            'phone' => $phone,
        ]);

        if ($result->isSuccess()) {
            return $result->getData()['client_id'] ?? null;
        }

        return null;
    }

    /**
     * Get client id by email
     *
     * @param string $email
     *
     * @return int|null
     */
    public function getClientIdByEmail(string $email): ?int
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_CLIENT_ID_BY_EMAIL, [
            'email' => $email,
        ]);
        if ($result->isSuccess()) {
            return $result->getData()['client_id'] ?? null;
        }

        return null;
    }

    /**
     * Get client id by variable's value
     *
     * @param string $var
     * @param        $val
     *
     * @return int|null
     */
    public function getClientIdByVar(string $var, $val): ?int
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_CLIENT_ID_BY_VAR, [
            'var' => $var,
            'val' => $val,
        ]);

        if ($result->isSuccess()) {
            return $result->getData()['client_id'] ?? null;
        }

        return null;
    }

    public function getVkSubscribers(int $page = 0, string $tag = '', ?int $group = null, ?int $dateFrom = null, ?int $dateTo = null)
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_VK_SUBSCRIBERS, [
            'page'      => $page,
            'tag'       => $tag,
            'group'     => $group,
            'date_from' => $dateFrom,
            'date_to'   => $dateTo,
        ]);

        return $result;
    }

    public function checkInstagramSubscription(string $userName, string $login = '')
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_CHECK_INSTAGRAM_SUBSCRIPTION, [
            'user_name' => $userName,
            'login'     => $login,
        ]);

        return $result;
    }

    public function checkWhatsApp(string $phone)
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_CHECK_WHATSAPP, [
            'phone' => $phone,
        ]);

        return $result;
    }

    /**
     * Get messages
     *
     * @return array|Message[]
     */
    public function getMessages(): array
    {
        $result = $this->getProtocol()->send('GET', self::METHOD_MESSAGES);

        if ($result->isSuccess()) {
            return array_map(function (array $item) {
                return new MessageModel(
                    $item['id'],
                    $item['condition'],
                    $item['answer'],
                    $item['message_type'],
                    $item['description']
                );
            }, $result->getData()['messages'] ?? []);
        }

        return [];
    }
}