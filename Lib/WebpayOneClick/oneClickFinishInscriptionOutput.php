<?php
namespace Tmwk\TransbankBundle\Lib\WebpayOneClick;

/**
 * Class oneClickFinishInscriptionOutput
 * @package Tmwk\TransbankBundle\Lib\WebpayOneClick
 */
class oneClickFinishInscriptionOutput
{
    /**
     * @var
     */
    public $authCode;

    /**
     * @var
     */
    public $creditCardType;

    /**
     * @var
     */
    public $last4CardDigits;

    /**
     * @var
     */
    public $responseCode;

    /**
     * @var
     */
    public $tbkUser;
}