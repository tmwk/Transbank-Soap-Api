<?php
namespace Tmwk\TransbankBundle\Lib;

use Tmwk\TransbankBundle\Lib\WebpayStandard\WebpayStandardWebService;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\WebpayOneClickWebService;

/**
 * Class TransbankServiceFactory
 * @package Tmwk\TransbankBundle\Lib
 */
class TransbankServiceFactory
{
    /**
     * @param CertificationBag $certificationBag
     * @param string|null $wsdlUrl
     * @return WebpayOneClick
     */
    static public function oneclick(CertificationBag $certificationBag, $wsdlUrl = null)
    {
        $service = new WebpayOneClickWebService($certificationBag, $wsdlUrl);
        return new WebpayOneClick($service);
    }

    /**
     * @param CertificationBag $certificationBag
     * @return WebpayPatPass
     */
    static public function patpass(CertificationBag $certificationBag, $wsdlUrl = null) {
        $service = new WebpayStandardWebService($certificationBag, $wsdlUrl);
        return new WebpayPatPass($service);
    }

    /**
     * @param CertificationBag $certificationBag
     * @param null $wsdlUrl
     * @return WebpayNormal
     */
    public static function normal(CertificationBag $certificationBag, $wsdlUrl = null)
    {
        $service = new WebpayStandardWebService($certificationBag, $wsdlUrl);
        return new WebpayNormal($service);
    }

    /**
     * @param CertificationBag $certificationBag
     * @param null $wsdlUrl
     * @return WebpayMall
     */
    public static function mall(CertificationBag $certificationBag, $wsdlUrl = null)
    {
        $service = new WebpayStandardWebService($certificationBag, $wsdlUrl);
        return new WebpayMall($service);
    }
}