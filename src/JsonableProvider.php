<?php
namespace Songbird\Package\Jsonable;

use League\Container\ContainerInterface;
use League\Route\RouteCollection;
use Songbird\PackageProviderAbstract;

class JsonableProvider extends PackageProviderAbstract
{
    /**
     * @param \League\Container\ContainerInterface $app
     * @param \League\Route\RouteCollection        $router
     */
    protected function registerRoutes(ContainerInterface $app, RouteCollection $router)
    {
        $router->addRoute(
            'GET',
            '/{documentId:[a-zA-Z0-9_\-\/]*}.json',
            'Songbird\Package\Jsonable\Controller::handle'
        );
    }
}
