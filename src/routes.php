<?php

use Slim\Http\Request;
use Slim\Http\Response;
use \App\Model\MemcachedSingleton;

// Routes
// the root doesn't resolve to any API

$app->any('/[{name}]', function(Request $request, Response $response, array $args){
	return $response->withJson(['Message' => 'Please choose an API'], 404);
});

$app->get('/{api_name}/[{api_method}]', function (Request $request, Response $response, array $args) {
    if ($response->getStatusCode() === 200)
    {
		try {
			$api = \App\Model\ApiFactory::create(
				$request,
				$response,
				$args,
				MemcachedSingleton::get_instance(\App\Model\MemcachedServerArrayGenerator::generate_servers_arr_from_app_settings($this)),
				$args['api_name']
			);

			return $api->call_api_method($args['api_method']);
		} catch (\Slim\Exception\NotFoundException $e) {
			return $response->withJson(['Message' => 'Api not found'], 404);
		}
    } else {
    	return $response;
    }
});
