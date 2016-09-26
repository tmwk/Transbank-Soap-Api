<?php
namespace Tmwk\TransbankBundle\Lib\WebpayStandard;

/**
 * Class wsInitTransactionInput
 * @package Tmwk\TransbankBundle\Lib\WebpayStandard
 */
class wsInitTransactionInput
{
    /**
     * @var string wsTransactionType
     */
    public $wSTransactionType;

    /**
     * @var string
     */
    public $commerceId;

    /**
     * @var string
     */
    public $buyOrder;

    /**
     * @var string
     */
    public $sessionId;

    /**
     * @var string anyURI
     */
    public $returnURL;

    /**
     * @var string anyURI
     */
    public $finalURL;

    /**
     * @var wsTransactionDetail
     */
    public $transactionDetails;

    /**
     * @var wpmDetailInput
     */
    public $wPMDetail;
}