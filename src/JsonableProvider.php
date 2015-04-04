<?php
namespace Songbird\Package\Jsonable;

use League\Event\Emitter;
use Songbird\PackageProviderAbstract;

class JsonableProvider extends PackageProviderAbstract
{
    /**
     * @param \League\Event\Emitter $event
     */
    protected function registerEventListeners(Emitter $event)
    {
        $event->addListener('RouterEvent', function ($event) {
            $event->router->addRoute(
                'GET',
                '/{fileId:[a-zA-Z0-9_\-\/]*}.json',
                'Songbird\Package\Jsonable\Handler::__invoke'
            );
        }, 100);
    }
}
