<?php

namespace SendBird\Requests;

use Carbon;

class User extends BaseRequest
{
    public function listUsers()
    {
        return $this->request('/users', 'get');
    }

    public function viewAUser($user_id)
    {
        return $this->request("/users/{$user_id}", 'get');
    }

    public function createUser($user_id, $username, $thumbnail)
    {
        $body = [
            'user_id' => $user_id,
            'nickname' => $username,
            'profile_url' => $thumbnail,
            'issue_access_token' => true,
            'issue_session_token' => true,
            'has_ever_logged_in' => true
        ];
        return $this->request('/users', 'post', $body);
    }

    public function updateUser($user_id, $username, $thumbnail)
    {
        $body = [
            'nickname' => $username,
            'profile_url' => $thumbnail,
            'issue_access_token' => true,
            'issue_session_token' => true,
            'is_active' => true,
            'has_ever_logged_in' => true,
            'last_seen_at' => Carbon::now()->timestamp
        ];
        return $this->request("/users/{$user_id}", 'put', $body);
    }

    public function addDeviceToken($user_id, $token_type, $token)
    {
        $body = [
            'user_id' => $user_id,
            'token_type' => $token_type
        ];

        $type = $token_type === "gcm" ? "gcm_reg_token" : "apns_device_token";

        $body[$type] = $token;
        return $this->request("/users/{$user_id}/push/{$token_type}", 'post', $body);
    }
}
