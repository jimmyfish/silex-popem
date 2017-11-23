<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 20/11/17
 * Time: 17:51
 */


$loader = require __DIR__ . '/../vendor/autoload.php';

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$config = require __DIR__ . '/../app/config.php';

$app = new \Silex\Application($config['common']);

require 'bootstrap.php';

$app->get('/', function () use ($app) {
    return $app->redirect($app['url_generator']->generate('api_login'));
});


$app->mount('/', new \Silex\Api\Http\Controller\UserController($app));

$app->run();