<?php
namespace Tmwk\TransbankBundle\Lib\WebpayOneClick;

use Tmwk\TransbankBundle\Lib\CertificationBag;
use Tmwk\TransbankBundle\Lib\TransbankSoap;
use Tmwk\TransbankBundle\Lib\TransbankWebService;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\authorize;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\authorizeResponse;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\baseBean;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\codeReverseOneClick;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\codeReverseOneClickResponse;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\finishInscription;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\finishInscriptionResponse;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\initInscription;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\initInscriptionResponse;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickFinishInscriptionInput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickFinishInscriptionOutput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickInscriptionInput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickInscriptionOutput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickPayInput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickPayOutput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickRemoveUserInput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickReverseInput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickReverseOutput;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\removeUser;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\removeUserResponse;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\reverse;
use Tmwk\TransbankBundle\Lib\WebpayOneClick\reverseResponse;

/**
 * Class WebpayOneClickWebService
 * @package Tmwk\TransbankBundle\Lib\WebpayOneClick
 */
class WebpayOneClickWebService extends TransbankWebService
{
    /**
     * Integration URL
     */
    const INTEGRATION_WSDL = 'https://webpay3gint.transbank.cl/webpayserver/wswebpay/OneClickPaymentService?wsdl';

    /**
     * Production URL
     */
    const PRODUCTION_WSDL = 'https://webpay3g.transbank.cl/webpayserver/wswebpay/OneClickPaymentService?wsdl';

    /**
     * @var array
     */
    protected static $classmap = array(
        'removeUser'                      => removeUser::class,
        'oneClickRemoveUserInput'         => oneClickRemoveUserInput::class,
        'baseBean'                        => baseBean::class,
        'removeUserResponse'              => removeUserResponse::class,
        'initInscription'                 => initInscription::class,
        'oneClickInscriptionInput'        => oneClickInscriptionInput::class,
        'initInscriptionResponse'         => initInscriptionResponse::class,
        'oneClickInscriptionOutput'       => oneClickInscriptionOutput::class,
        'finishInscription'               => finishInscription::class,
        'oneClickFinishInscriptionInput'  => oneClickFinishInscriptionInput::class,
        'finishInscriptionResponse'       => finishInscriptionResponse::class,
        'oneClickFinishInscriptionOutput' => oneClickFinishInscriptionOutput::class,
        'codeReverseOneClick'             => codeReverseOneClick::class,
        'oneClickReverseInput'            => oneClickReverseInput::class,
        'codeReverseOneClickResponse'     => codeReverseOneClickResponse::class,
        'oneClickReverseOutput'           => oneClickReverseOutput::class,
        'authorize'                       => authorize::class,
        'oneClickPayInput'                => oneClickPayInput::class,
        'authorizeResponse'               => authorizeResponse::class,
        'oneClickPayOutput'               => oneClickPayOutput::class,
        'reverse'                         => reverse::class,
        'reverseResponse'                 => reverseResponse::class
    );


    /**
     * Permite realizar la inscripción del tarjetahabiente e información de su tarjeta de crédito. Retorna como respuesta un token que representa la transacción de inscripción y una URL (UrlWebpay), que corresponde a la URL de inscripción de One Click.
     * Una vez que se llama a este servicio Web, el usuario debe ser redireccionado vía POST a urlWebpay con parámetro TBK_TOKEN igual al token obtenido.
     *
     * @param oneClickInscriptionInput $oneClickInscriptionInput
     * @return initInscriptionResponse
     */
    public function initInscription(oneClickInscriptionInput $oneClickInscriptionInput)
    {
        $initInscription       = new initInscription();
        $initInscription->arg0 = $oneClickInscriptionInput;
        return $this->callSoapMethod('initInscription', $initInscription);
    }

    /**
     * Permite finalizar el proceso de inscripción del tarjetahabiente en Oneclick. Entre otras cosas, retorna el identificador del usuario en Oneclick, el cual será utilizado para realizar las transacciones de pago.
     * Una vez terminado el flujo de inscripción en Transbank el usuario es enviado a la URL de fin de inscripción que definió el comercio. En ese instante el comercio debe llamar a finishInscription.
     *
     * @param oneClickFinishInscriptionInput $finishInscriptionInput
     * @return finishInscriptionResponse
     */
    public function finishInscription(oneClickFinishInscriptionInput $finishInscriptionInput)
    {
        $finishInscription       = new finishInscription();
        $finishInscription->arg0 = $finishInscriptionInput;

        return $this->callSoapMethod('finishInscription', $finishInscription);
    }

    /**
     * Permite realizar transacciones de pago. Retorna el resultado de la autorización. Este método que debe ser ejecutado, cada vez que el
     * usuario selecciona pagar con Oneclick.
     *
     * @param \Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickPayInput $authorizeInput
     * @return \Tmwk\TransbankBundle\Lib\WebpayOneClick\authorizeResponse
     */
    public function authorize(oneClickPayInput $authorizeInput)
    {
        $authorize       = new authorize();
        $authorize->arg0 = $authorizeInput;
        return $this->callSoapMethod('authorize', $authorize);
    }

    /**
     * Permite reversar una transacción de venta autorizada con anterioridad. Este método retorna como respuesta un identificador único de la
     * transacción de reversa.
     *
     * @param \Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickReverseInput $codeReverseOneClickInput
     * @return \Tmwk\TransbankBundle\Lib\WebpayOneClick\codeReverseOneClickResponse
     */
    public function codeReverseOneClick(oneClickReverseInput $codeReverseOneClickInput)
    {
        $codeReverseOneClick       = new codeReverseOneClick();
        $codeReverseOneClick->arg0 = $codeReverseOneClickInput;

        return $this->callSoapMethod('codeReverseOneClick', $codeReverseOneClick);
    }

    /**
     * Permite eliminar una inscripción de usuario en Transbank
     *
     * @param \Tmwk\TransbankBundle\Lib\WebpayOneClick\oneClickRemoveUserInput $removeUserInput
     * @return removeUserResponse
     */
    public function removeUser(oneClickRemoveUserInput $removeUserInput)
    {
        $removeUser       = new removeUser();
        $removeUser->arg0 = $removeUserInput;
        return $this->callSoapMethod('removeUser', $removeUser);
    }

}


?>