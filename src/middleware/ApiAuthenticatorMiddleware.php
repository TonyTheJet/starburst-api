<?php
	namespace App\Middleware;
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Slim\Http\Response as Response;
	use \Illuminate\Database\Capsule\Manager;
	class ApiAuthenticatorMiddleware {

		// constants
		private const STATUS_CODE_UNAUTHORIZED = 401;
		// end constants

		private $api_id;
		private $api_token;
		private $db_manager;

		/**
		 * @var Request
		 */
		private $request;

		/**
		 * @var Response
		 */
		private $response;

		public function __construct(Manager $db_manager) {
			$this->db_manager = $db_manager;
		}

		/**
		 * Example middleware invokable class
		 *
		 * @param  \Psr\Http\Message\ServerRequestInterface $request PSR7 request
		 * @param \Psr\Http\Message\ResponseInterface|Response $response PSR7 response
		 * @param  callable $next Next middleware
		 *
		 * @return \Psr\Http\Message\ResponseInterface
		 */
		public function __invoke(Request $request, Response $response, callable $next)
		{
			$this->request = $request;
			$this->response = $response;
			if (!empty($this->request->getHeader('PHP_AUTH_USER')))
				$this->api_id = $this->request->getHeader('PHP_AUTH_USER')[0];

			if (!empty($this->request->getHeader('PHP_AUTH_PW')))
				$this->api_token = $this->request->getHeader('PHP_AUTH_PW')[0];

			$this->authenticate_request();

			$this->response = $next($request, $this->response);

			return $this->response;
		}

		// private methods
		private function authenticate_request(): void {

			// make sure they even tried to authenticate
			if (!empty($this->api_id) && !empty($this->api_token))
			{
				// is the user a valid one with a valid ID?
				if ($this->id_and_token_are_valid())
				{

					// does the user have enough requests available?
					if (!$this->user_under_request_limit())
					{
						$this->set_unauthorized_status_in_response('User has exceeded monthly request limit');
					}
				}
				else
				{
					$this->set_unauthorized_status_in_response('API ID and/or API Token invalid');
				}
			}
			else
			{
				$this->set_unauthorized_status_in_response('You are not authorized to make this request');
			}
		}

		/**
		 * @return bool
		 */
		private function id_and_token_are_valid(): bool {
			// TODO: implement this method
			if ($this->api_id === 'tanderson' && $this->api_token === 'stuff')
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		private function set_unauthorized_status_in_response(string $message): void {
			$this->response = $this->response->withJson(['Message' => $message], self::STATUS_CODE_UNAUTHORIZED);
		}

		private function user_under_request_limit(): bool {
			// TODO: implement this method
			return true;
		}
		// end private methods
	}