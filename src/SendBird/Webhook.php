<?php

namespace SendBird;

class Webhook
{
    public function validateResponse($payload, $x_signature)
    {
        $secret = env('SENDBIRD_MASTER_TOKEN', '');

        $signature = hash_hmac('sha256', $payload, $secret);

        return $x_signature === $signature;
    }
}
