<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 20/11/17
 * Time: 17:51
 */

/**
 * register Doctrine Service Provider
 */
$app->register(new \Silex\Provider\DoctrineServiceProvider(), $config['db']);

/**
 * register Doctrine Orm Service Provider
 */
$app->register(new \Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), $config['orm']);

/**
 * register Twig Service Provider
 */
$app->register(new \Silex\Provider\TwigServiceProvider(), $config['twig']);

/**
 * Register Form Service Provider
 */
$app->register(new \Silex\Provider\FormServiceProvider());

/**
 * Register Translation Service Provider
 */
$app->register(new \Silex\Provider\TranslationServiceProvider());

/**
 * Register Session Service Provider
 */
$app->register(new \Silex\Provider\SessionServiceProvider());

/**
 * Register Url Generator Service Provider
 */
$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

/**
 * Register Controller Service Provider
 */
$app->register(new \Silex\Provider\ServiceControllerServiceProvider());

/**
 * Register Http Fragment Service Provider
 */
$app->register(new \Silex\Provider\HttpFragmentServiceProvider());

/**
 * Register Validator Service Provider
 */
$app->register(new \Silex\Provider\ValidatorServiceProvider());

$app['user.repository'] = function () use ($app) {
    return $app['orm.em']->getRepository(\Silex\Api\Domain\Entity\User::class);
};

$app['category.repository'] = function () use ($app) {
    return $app['orm.em']->getRepository(\Silex\Api\Domain\Entity\Category::class);
};

$app['article.repository'] = function () use ($app) {
    return $app['orm.em']->getRepository(\Silex\Api\Domain\Entity\Article::class);
};


