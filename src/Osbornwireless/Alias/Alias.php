<?php
/**
 * eSports CMS
 *
 * @project OWNet
 * @author kreeck
 *
 */
namespace Osbornwireless\Alias;

use Illuminate\Support\Facades\Request as Request,
    Illuminate\Support\Facades\Route as Route;

class Alias {

    private $routes;

    private $currentRoute = array();

    public function __construct()
    {
        $this->routes = \UrlAlias::all()->toArray();
    }

    public function pathExists( $path )
    {
        foreach( $this->routes as $key => $route )
        {
            if( $route['route'] == $path )
            {
                $this->currentRoute = $route;
                return true;
            }
        }

        return false;
    }

    public function aliasExists( $path )
    {
        foreach( $this->routes as $key => $route )
        {
            if( $route[ 'query' ] == $path )
            {
                $this->currentRoute = $route;
                return true;
            }
        }

        return false;
    }

    public function generateLink( $path )
    {
        if( $this->aliasExists($path) )
        {
            return $this->currentRoute['route'];
        }

        return $path;
    }

    public function checkPath( $path )
    {
        if( $this->pathExists($path) )
        {
            Route::get( $this->currentRoute['route'], array('uses'=>"{$this->currentRoute['factory']}@{$this->currentRoute['method']}"));
        }
    }
}