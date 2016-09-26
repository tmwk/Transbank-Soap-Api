<?php
namespace Tmwk\TransbankBundle\Lib;

/**
 * Class SecurityHelper
 * @package Tmwk\TransbankBundle\Lib
 */
class SecurityHelper
{
    /**
     * @param $X509Cert
     * @return mixed
     */
    public static function getCommonName($X509Cert)
    {
        $handler = fopen($X509Cert, 'r');
        $cert = fread($handler, 8192);
        fclose($handler);
        $cert_as_array = openssl_x509_parse($cert);
        return $cert_as_array['subject']['CN'];
    }
}