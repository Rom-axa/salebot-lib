<?php namespace professionalweb\salebot\Interfaces\Services;

use professionalweb\salebot\Interfaces\Models\Attachment;

/**
 * Interface for Salebot service
 * @package professionalweb\salebot\Interfaces\Services
 */
interface SalebotService
{
    public function callback(string $message, string $phone = '', string $email = '', string $id = '');

    public function vkCallback(string $groupId, string $userId, string $message = '');

    public function whatsappCallback(string $phone, string $name = '', string $message = '', string $botId = '');

    public function okCallback(string $groupId, string $userId, string $message);

    public function tgCallback(string $groupId, string $userId, string $message);

    public function sendMessage(string $clientId, string $message = '', string $messageId = '', ?Attachment $attachment = null, array $buttons = []);

    public function broadcast(array $clientIds = [], string $message = '', string $messageId = '', string $list = '', float $shift = 0.2, ?Attachment $attachment = null, array $buttons = []);

    public function whatsappMessage(string $phone, string $message = '', string $messageId = '', string $whatsappBotId = '', ?Attachment $attachment = null);

    public function saveVariables(string $clientId, array $variables, array $clientsId = []);

    public function getVariables(string $clientId);

    public function getClients(int $limit, int $offset);

    public function getHistory(string $clientId);

    public function clearHistory(string $clientId);

    public function getConnectedChannels();

    public function getOnlineChatClientId(string $recipient, string $name = '', string $tag = '');

    public function uploadClients(array $clients);

    public function getClientIdByWhatsApp(string $phone);

    public function getClientIdByPhone(string $phone);

    public function getClientIdByEmail(string $email);

    public function getClientIdByVar(string $var, $val);

    public function getVkSubscribers(int $page = 0, string $tag = '', ?int $group = null, ?int $dateFrom = null, ?int $dateTo = null);

    public function checkInstagramSubscription(string $userName, string $login = '');

    public function checkWhatsApp(string $phone);

    public function getMessages();
}