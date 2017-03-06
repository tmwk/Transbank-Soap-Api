<?php
namespace Tmwk\TransbankBundle\Lib;

use Tmwk\TransbankBundle\Lib\Exceptions\InvalidCertificateException;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\WebpayOneClickWebService;
use Tmwk\TransbankBundle\Lib\WssParse\SoapValidationParse as SoapValidation;
use Tmwk\TransbankBundle\Lib\Logger;


/**
 * Class TransbankWebService
 * @package Tmwk\TransbankBundle\Lib
 */
abstract class TransbankWebService 
{

    /**
     * @var TransbankSoap
     */
    protected $soapClient;

    /**
     * @var CertificationBag
     */
    protected $certificationBag;

    /**
     * @var
     */
    protected static $classmap = [];

    /**
     * WebpayOneClick constructor.
     * @param CertificationBag $certificationBag
     * @param string $url
     * @internal param LoggerInterface $logger
     */
    public function __construct(CertificationBag $certificationBag, $url = null)
    {
        $url = $this->getWsdlUrl($certificationBag, $url);

        $this->certificationBag = $certificationBag;

        $this->soapClient = new TransbankSoap($url, [
            'classmap'   => static::$classmap,
            'trace'      => true,
            'exceptions' => true
        ]);

        $this->soapClient->setCertificate($this->certificationBag->getClientCertificate());
        $this->soapClient->setPrivateKey($this->certificationBag->getClientPrivateKey());
    }

    /**
     * @return CertificationBag
     */
    public function getCertificationBag()
    {
        return $this->certificationBag;
    }

    /**
     * @param CertificationBag $certificationBag
     */
    public function setCertificationBag(CertificationBag $certificationBag)
    {
        $this->certificationBag = $certificationBag;
    }

    /**
     * @return TransbankSoap
     */
    public function getSoapClient()
    {
        return $this->soapClient;
    }

    /**
     * @throws InvalidCertificateException
     */
    public function validateResponseCertificate()
    {
        $xmlResponse = $this->getLastRawResponse();

        $soapValidation = new SoapValidation($xmlResponse, $this->certificationBag->getServerCertificate());
        $validation     = $soapValidation->getValidationResult(); //Esto valida si el mensaje está firmado por Transbank

        if ($validation !== true) {
            $msg = 'The Transbank response fails on the certificate signature validation. Response doesn\t comes from Transbank';
            Logger::log()->error($msg);

            throw new InvalidCertificateException($msg);
        }
    }

    /**
     * @param $method
     * @return mixed
     * @throws InvalidCertificateException
     * @throws \SoapFault
     */
    protected function callSoapMethod($method)
    {
        //Get arguments, and remove the first one ($method) so the $args array will just have the additional paramenters
        $args = func_get_args();
        array_shift($args);

        Logger::log()->info('request_object', $args);

        try {
            $response = call_user_func_array([$this->getSoapClient(), $method], $args);
            Logger::log()->info('response_object', array($response));
        } catch (\SoapFault $e) {
            Logger::log()->error('SOAP ERROR (' . $e->faultcode . '): ' . $e->getMessage());
            throw new \SoapFault($e->faultcode, $e->faultstring);
        }

        //Validate the signature of the response
        $this->validateResponseCertificate();

        Logger::$log->info('Response certificate validated successfully');

        return $response;
    }

    /**
     * This method allows you to call any method on the SoapClient
     * @param $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        array_unshift($arguments, $name);
        return call_user_func_array([$this, 'callSoapMethod'], $arguments);
    }

    /**
     * @return string
     */
    protected function getLastRawResponse()
    {
        $xmlResponse = $this->getSoapClient()->__getLastResponse();
        return $xmlResponse;
    }

    /**
     * @param CertificationBag $certificationBag
     * @param $url
     * @return string
     */
    public function getWsdlUrl(CertificationBag $certificationBag, $url = null)
    {
        if ($url) {
            return $url;
        }

        if ($certificationBag->getEnvironment() == CertificationBag::PRODUCTION) {
            return static::PRODUCTION_WSDL;
        }

        return static::INTEGRATION_WSDL;
    }
}