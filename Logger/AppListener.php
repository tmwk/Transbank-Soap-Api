<?php
    /**
     * Created by PhpStorm.
     * User: VAIO
     * Date: 09/03/2016
     * Time: 10:19
     */

    namespace Tmwk\TransbankBundle\Logger;

    use Symfony\Component\HttpKernel\Log\LoggerInterface;

    class AppListener
    {
        protected $logger;

        public function __construct(LoggerInterface $logger)
        {
            $this->logger = $logger;
        }

        /**
         * Adds a log record at an arbitrary level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  mixed   $level   The log level
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function log($level, $message, array $context = array())
        {
            return $this->logger->log($level, $message, $context);
        }

        /**
         * Adds a log record at the DEBUG level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function debug($message, array $context = array())
        {
            return $this->logger->debug($message, $context);
        }

        /**
         * Adds a log record at the INFO level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function info($message, array $context = array())
        {
            return $this->logger->info($message, $context);
        }

        /**
         * Adds a log record at the NOTICE level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function notice($message, array $context = array())
        {
            return $this->logger->notice($message, $context);
        }

        /**
         * Adds a log record at the WARNING level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function warn($message, array $context = array())
        {
            return $this->logger->warn($message, $context);
        }

        /**
         * Adds a log record at the WARNING level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function warning($message, array $context = array())
        {
            return $this->logger->warning($message, $context);
        }

        /**
         * Adds a log record at the ERROR level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function err($message, array $context = array())
        {
            return $this->logger->err($message, $context);
        }

        /**
         * Adds a log record at the ERROR level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function error($message, array $context = array())
        {
            return $this->logger->error($message, $context);
        }

        /**
         * Adds a log record at the CRITICAL level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function crit($message, array $context = array())
        {
            return $this->logger->crit($message, $context);
        }

        /**
         * Adds a log record at the CRITICAL level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function critical($message, array $context = array())
        {
            return $this->logger->critical($message, $context);
        }

        /**
         * Adds a log record at the ALERT level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function alert($message, array $context = array())
        {
            return $this->logger->alert($message, $context);
        }

        /**
         * Adds a log record at the EMERGENCY level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function emerg($message, array $context = array())
        {
            return $this->logger->emerg($message, $context);
        }

        /**
         * Adds a log record at the EMERGENCY level.
         *
         * This method allows for compatibility with common interfaces.
         *
         * @param  string  $message The log message
         * @param  array   $context The log context
         * @return Boolean Whether the record has been processed
         */
        public function emergency($message, array $context = array())
        {
            return $this->logger->emergency($message, $context);
        }
    }