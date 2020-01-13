<?php

namespace SendBird;

class SendBird
{
    const USER = 'User';
    const CHANNEL = 'Channel';
    const MESSAGE = 'Message';

    public static function getInstance($key)
    {
        $class = "App\SendBird\Requests\\".$key;
        if (!class_exists($class)) {
            throw new \Exception("{$class} not exists");
        }

        return new $class;
    }

    public static function getConst($name)
    {
        $name = strtoupper($name);
        return constant("self::{$name}");
    }
}
