<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->add(new App\Middleware\ApiSetupMiddleware());
$app->add(new App\Middleware\ApiAuthenticatorMiddleware($app->getContainer()['db']));