<?php
namespace Songbird\Package\Jsonable;

use League\Container\ContainerInterface;
use Songbird\PackageProviderAbstract;

class JsonableProvider extends PackageProviderAbstract
{
    /**
     * @param \League\Container\ContainerInterface       $app
     * @param \Songbird\Package\Jsonable\RouteCollection $router
     */
    protected function registerRoutes(ContainerInterface $app, RouteCollection $router)
    {
        $router->addRoute(
            'GET',
            '/{documentId:[a-zA-Z0-9_\-\/]*}.{format:[(json)]*}',
            'Songbird\Package\Jsonable\Controller'
        );
    }
}
