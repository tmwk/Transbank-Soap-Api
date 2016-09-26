<?php
namespace Tmwk\TransbankBundle\Lib;

/**
 * Class WebpayMall
 * @package Tmwk\TransbankBundle\Lib
 */
class WebpayMall extends WebpayWebService
{
    /**
     * @param $returnURL
     * @param $finalURL
     * @param $buyOrder
     * @param null $sessionId
     * @param null $commerceCode
     * @return WebpayStandard\wsInitTransactionOutput
     */
    public function init($returnURL, $finalURL, $buyOrder, $sessionId = null, $commerceCode = null)
    {
        return $this->initTransaction($returnURL, $finalURL, $sessionId, self::TIENDA_MALL, $buyOrder, $commerceCode);
    }
}