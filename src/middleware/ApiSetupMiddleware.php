<?php
namespace App\Middleware;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;
class ApiSetupMiddleware {

	/**
	 * Example middleware invokable class
	 *
	 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
	 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
	 * @param  callable                                 $next     Next middleware
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function __invoke(Request $request, Response $response, callable $next)
	{
		$response = $response->withHeader('content-type', 'application/json');
		return $next($request, $response);
	}
}