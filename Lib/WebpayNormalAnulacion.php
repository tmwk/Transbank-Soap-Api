<?php
namespace Tmwk\TransbankBundle\Lib;

/**
 * Class nullify
 * @package Tmwk\TransbankBundle\Lib
 */
class nullify
{
    /**
     * @var nullificationInput
     */
    public $nullificationInput;
}

/**
 * Class nullificationInput
 * @package Tmwk\TransbankBundle\Lib
 */
class nullificationInput
{
    /**
     * @var int
     */
    public $commerceId;

    /**
     * @var string
     */
    public $buyOrder;

    /**
     * @var float
     */
    public $authorizedAmount;

    /**
     * @var string
     */
    public $authorizationCode;

    /**
     * @var float
     */
    public $nullifyAmount;
}

/**
 * Class baseBean
 * @package Tmwk\TransbankBundle\Lib
 */
class baseBean
{

}

/**
 * Class nullifyResponse
 * @package Tmwk\TransbankBundle\Lib
 */
class nullifyResponse
{
    /**
     * @var nullificationOutput
     */
    public $return;
}

/**
 * Class nullificationOutput
 * @package Tmwk\TransbankBundle\Lib
 */
class nullificationOutput
{
    /**
     * @var string
     */
    public $authorizationCode;

    /**
     * @var float
     */
    public $authorizationDate;

    /**
     * @var float
     */
    public $balance;

    /**
     * @var float
     */
    public $nullifiedAmount;

    /**
     * @var string
     */
    public $token;
}

/**
 * Class capture
 * @package Tmwk\TransbankBundle\Lib
 */
class capture
{
    /**
     * @var captureInput
     */
    public $captureInput;
}

/**
 * Class captureInput
 * @package Tmwk\TransbankBundle\Lib
 */
class captureInput
{
    /**
     * @var int
     */
    public $commerceId;

    /**
     * @var string
     */
    public $buyOrder;

    /**
     * @var string
     */
    public $authorizationCode;

    /**
     * @var float
     */
    public $captureAmount;
}

/**
 * Class captureResponse
 * @package Tmwk\TransbankBundle\Lib
 */
class captureResponse
{
    /**
     * @var captureOutput
     */
    public $return;
}

/**
 * Class captureOutput
 * @package Tmwk\TransbankBundle\Lib
 */
class captureOutput
{
    /**
     * @var string
     */
    public $authorizationCode;

    /**
     * @var dateTime
     */
    public $authorizationDate;

    /**
     * @var float
     */
    public $capturedAmount;

    /**
     * @var string
     */
    public $token;
}

/**
 * Class WebpayNormalAnulacion
 * @package Tmwk\TransbankBundle\Lib
 */
class WebpayNormalAnulacion
{
    /**
     * @var TransbankSoap
     */
    public $soapClient;

    /**
     * @var array
     */
    private static $classmap = array(
        'nullify'             => 'nullify',
        'nullificationInput'  => 'nullificationInput',
        'baseBean'            => 'baseBean',
        'nullifyResponse'     => 'nullifyResponse',
        'nullificationOutput' => 'nullificationOutput',
        'capture'             => 'capture',
        'captureInput'        => 'captureInput',
        'captureResponse'     => 'captureResponse',
        'captureOutput'       => 'captureOutput'
    );

    const INTEGRATION_WSDL = 'https://tbk.orangepeople.cl/WSWebpayTransaction/cxf/WSCommerceIntegrationService?wsdl';

    /**
     * @param string $url
     */
    public function __construct($url = self::INTEGRATION_WSDL)
    {
        $this->soapClient = new TransbankSoap($url, array(
            'classmap'   => self::$classmap,
            'trace'      => true,
            'exceptions' => true
        ));
    }

    /**
     * @param $nullify
     * @return mixed
     */
    public function nullify($nullify)
    {
        $nullifyResponse = $this->soapClient->nullify($nullify);
        return $nullifyResponse;
    }

    /**
     * @param $capture
     * @return mixed
     */
    public function capture($capture)
    {
        $captureResponse = $this->soapClient->capture($capture);
        return $captureResponse;
    }
}

?>