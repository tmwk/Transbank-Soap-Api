<?php
/**
 * Created by PhpStorm.
 * User: Mario Figueroa
 * Email: mfigueroa@tmwk.cl
 * Date: 03/02/2017
 * Time: 11:55
 */

namespace Tmwk\TransbankBundle\Lib;

use Monolog\Logger as Monolog;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Logger
{

    public static function log()
    {
        $logger = new Monolog('transbank');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../../../../../app/logs/transbank.log', Monolog::DEBUG));

        return  $logger->pushHandler(new FirePHPHandler());
    }
}