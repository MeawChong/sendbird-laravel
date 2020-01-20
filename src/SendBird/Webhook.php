<?php

namespace SendBird;

class Webhook
{
    public function validateResponse($payload, $x_signature)
    {
        $secret = config('master_token');

        $signature = hash_hmac('sha256', $payload, $secret);

        return $x_signature === $signature;
    }
}
