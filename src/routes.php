<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    if ($response->getStatusCode() === 200)
    {
	    return $response->withJson(['Message' => 'You are in!!!'], 200);
    }

	// Sample log message
    //$this->logger->info(print_r($this, true) . "\n\n\n\n");
	// database is $this

    // Render index view
    //return $this->renderer->render($response, 'index.phtml', $args);
});
