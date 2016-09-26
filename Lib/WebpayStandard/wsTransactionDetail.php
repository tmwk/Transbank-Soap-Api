<?php
namespace Tmwk\TransbankBundle\Lib\WebpayStandard;

/**
 * Class wsTransactionDetail
 * @package Tmwk\TransbankBundle\Lib\WebpayStandard
 */
class wsTransactionDetail
{
    /**
     * @var float
     */
    public $sharesAmount;

    /**
     * @var int
     */
    public $sharesNumber;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var string
     */
    public $commerceCode;

    /**
     * @var string
     */
    public $buyOrder;
}