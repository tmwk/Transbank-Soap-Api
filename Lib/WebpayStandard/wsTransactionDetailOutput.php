<?php
namespace Tmwk\TransbankBundle\Lib\WebpayStandard;

/**
 * Class wsTransactionDetailOutput
 * @package Tmwk\TransbankBundle\Lib\WebpayStandard
 */
class wsTransactionDetailOutput
{
    /**
     * @var string
     */
    public $authorizationCode;

    /**
     * @var string
     */
    public $paymentTypeCode;

    /**
     * @var int
     */
    public $responseCode;
}