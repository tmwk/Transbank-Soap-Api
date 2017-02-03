<?php
namespace Tmwk\TransbankBundle\Lib;

use Tmwk\TransbankBundle\Lib\Log\LoggerInterface;
use Tmwk\TransbankBundle\Lib\Log\LogHandler;
use SoapClient;
use Tmwk\TransbankBundle\Lib\WssParse\WSSESoapParse as WSSESoap;
use Tmwk\TransbankBundle\Lib\WssParse\XMLSecurityKeyParse as XMLSecurityKey;

/**
 * Class TransbankSoap
 * @package Tmwk\TransbankBundle\Lib
 */
class TransbankSoap extends SoapClient
{
    /**
     * Client's private key
     * @var string
     */
    protected $privateKey;

    /**
     * Client's public certificate
     * @var string
     */
    protected $certificate;

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @param mixed $privateKey
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
    }

    /**
     * @return mixed
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * @param mixed $certificate
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * @param string $request
     * @param string $location
     * @param string $saction
     * @param int $version
     * @param null $one_way
     * @return string
     * @throws \Exception
     */
    public function __doRequest($request, $location, $saction, $version, $one_way = NULL)
    {
        Logger::log()->info('unsigned_request_raw', ['location' => $location, 'xml' => $request]);

        $doc = new \DOMDocument('1.0');
        $doc->loadXML($request);
        $objWSSE = new WSSESoap($doc);
        $objKey  = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' =>
                                                                          'private'));
        $objKey->loadKey($this->getPrivateKey(), TRUE);
        $options = array('insertBefore' => TRUE);
        $objWSSE->signSoapDoc($objKey, $options);
        $objWSSE->addIssuerSerial($this->getCertificate());
        $objKey = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
        $objKey->generateSessionKey();

        $signed_request = $objWSSE->saveXML();
        Logger::log()->info('signed_request_raw', ['location' => $location, 'xml' => $signed_request]);

        $retVal = parent::__doRequest($signed_request, $location, $saction,
            $version, $one_way);
        $doc    = new \DOMDocument();
        $doc->loadXML($retVal);
        Logger::log()->info('response_raw', ['location' => $location, 'xml' => $retVal]);
        return $doc->saveXML();
    }


}
