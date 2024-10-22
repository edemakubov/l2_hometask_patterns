<?php

class Superman
{
    private static $instance = null;

    protected function __construct(public string $name = 'Clark Kent')
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Superman();
        }
        return self::$instance;
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
    }
}