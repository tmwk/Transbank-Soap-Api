<?php
namespace Tmwk\TransbankBundle\Lib;

/**
 * Class WebpayPatPass
 * @package Tmwk\TransbankBundle\Lib
 */
class WebpayPatPass extends WebpayWebService
{
    /**
     * @param $returnURL
     * @param $finalURL
     * @param null $sessionId
     * @return WebpayStandard\wsInitTransactionOutput
     */
    public function init($returnURL, $finalURL, $sessionId = null)
    {
        return $this->initTransaction($returnURL, $finalURL, $sessionId, self::PATPASS);
    }
}