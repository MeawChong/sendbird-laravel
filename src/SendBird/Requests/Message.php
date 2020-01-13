<?php

namespace Sendbird\Requests;

class Message extends BaseRequest
{
    public function sendMessage($messsage, $messsage_type, $sender_id, $channel_url, $channel_type = 'group_channels')
    {
        $body = [
            'channel_type' => $channel_type,
            'channel_url' => $channel_url,
            'message_type' => $messsage_type,
            'message' => $messsage,
            'user_id' => $sender_id
        ];
        
        return $this->request("/{$channel_type}/{$channel_url}/messages", 'post', $body);
    }

    public function sendAdminMessage($messsage, $channel_url, $channel_type = 'group_channels')
    {
        $body = [
            'channel_type' => $channel_type,
            'channel_url' => $channel_url,
            'message_type' => 'ADMM',
            'message' => $messsage
        ];
        
        return $this->request("/{$channel_type}/{$channel_url}/messages", 'post', $body);
    }
}