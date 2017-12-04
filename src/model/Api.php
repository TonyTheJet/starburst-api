<?php
	namespace  App\Model;
	use \Slim\Http\Request;
	use \Slim\Http\Response;
	abstract class Api {

		// protected members
		/**
		 * @var array
		 */
		protected $args;
		/**
		 * @var Request
		 */
		protected $request;
		/**
		 * @var Response
		 */
		protected $response;
		// end protected members

		public function __construct(Request $request, Response $response, array $args) {
			$this->request = $request;
			$this->response = $response;
			$this->args = $args;
		}


		// abstract public functions
		abstract public function call_api_method(string $method_name): Response;
		// end abstract public functions
	}