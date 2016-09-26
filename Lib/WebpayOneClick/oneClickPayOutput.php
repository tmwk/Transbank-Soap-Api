<?php
namespace Tmwk\TransbankBundle\Lib\WebpayOneClick;

/**
 * Class oneClickPayOutput
 * @package Tmwk\TransbankBundle\Lib\WebpayOneClick
 */
class oneClickPayOutput
{
    /**
     * @var
     * type: string
     */
    public $authorizationCode;

    /**
     * @var
     * type: Credit Card Type
     */
    public $creditCardType;

    /**
     * @var
     * type: string
     */
    public $last4CardDigits;

    /**
     * @var
     * type: int
     */
    public $responseCode;

    /**
     * @var
     * type: long
     */
    public $transactionId;
}