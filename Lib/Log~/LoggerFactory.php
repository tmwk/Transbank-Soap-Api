<?php

namespace Tmwk\TransbankBundle\Lib\Log;

/**
 * Class LoggerFactory
 * @package Tmwk\TransbankBundle\Lib\Log
 */
class LoggerFactory
{
    /**
     * @var LoggerInterface
     */
    private static $instance;

    /**
     * @param LoggerInterface $instance
     */
    public static function setLogger(LoggerInterface $instance)
    {
        self::$instance = $instance;
    }

    /**
     * @return LoggerInterface
     */
    public static function logger()
    {
        if (!self::$instance) {
            self::initDefaultLogger();
        }

        return self::$instance;
    }

    /**
     * @return VoidLogger
     */
    public static function initDefaultLogger()
    {
        return self::$instance = new VoidLogger();
    }
}