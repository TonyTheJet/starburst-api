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
		 * @var \Memcached|null
		 */
		protected $cache;

		/**
		 * @var Request
		 */
		protected $request;
		/**
		 * @var Response
		 */
		protected $response;
		// end protected members

		public function __construct(Request $request, Response $response, array $args, \Memcached $cache = null) {
			$this->request = $request;
			$this->response = $response;
			$this->args = $args;
			$this->cache = $cache;
		}


		// abstract public functions
		abstract public function call_api_method(string $method_name): Response;
		// end abstract public functions
	}