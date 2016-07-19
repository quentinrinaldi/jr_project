<?php 

namespace UserBundle\Handler;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticationFailureHandler extends DefaultAuthenticationFailureHandler {

	protected $service_container;

    public function __construct( HttpKernelInterface $httpKernel, HttpUtils $httpUtils, array $options, LoggerInterface $logger = null, $service_container ) {
        parent::__construct( $httpKernel, $httpUtils, $options, $logger );
        $this->service_container = $service_container;
    }

  /*  public function onAuthenticationFailure( Request $request, AuthenticationException $exception ) {
        if( $request->isXmlHttpRequest() ) {
            $response = new JsonResponse( array( 'success' => false, 'message' => $exception->getMessage(), 'error' => true ) );
        } else {
            $response = parent::onAuthenticationFailure( $request, $exception );
        }
        return $response;
    }*/

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
		$result = array(
			'success' => false, 
			'function' => 'onAuthenticationFailure', 
			'error' => true,
			'message' => $this->service_container->get('translator')->trans($exception->getMessage(), array(), 'FOSUserBundle')
			);
		$response = new Response(json_encode($result));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	} 
}

/*class AuthentificationHandler implements  AuthenticationFailureHandlerInterface {


	public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
		$result = array(
			'success' => false, 
			'function' => 'onAuthenticationFailure', 
			'error' => true, 
			'message' => $this->get('translator')->trans($exception->getMessage(), array(), 'FOSUserBundle')
			);
		$response = new Response(json_encode($result));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	} 
}
