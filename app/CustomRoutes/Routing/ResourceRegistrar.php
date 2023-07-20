<?php

namespace App\CustomRoutes\Routing;

use Illuminate\Routing\ResourceRegistrar;

class CustomResourceRegistrar extends ResourceRegistrar
{
    // add data to the array
    /**
     * The default actions for a resourceful controller.
     *
     * @var array
     */
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'data'];


    /**
     * Add the data method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceData($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/tabledata';

        $action = $this->getResourceAction($name, $controller, 'data', $options);

        return $this->router->get($uri, $action);
    }
}