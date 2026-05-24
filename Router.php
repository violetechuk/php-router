<?php
/**
 * PHP Router
 * A simple and lightweight PHP router for handling HTTP requests and routing them to the appropriate callbacks.
 * 
 * @license MIT License (https://opensource.org/licenses/MIT)
 * @author Violetech (https://www.violetech.co.uk)
 */

namespace Violetech;

class SimpleRouter
{
    /**
     * @var array $routes Routes.
     */
    private array $routes = [];
    
    /**
     * Add a route.
     * 
     * @param string $method HTTP method (GET, POST, etc.).
     * @param string $route Route path.
     * @param callable $callback Callback function to handle the route.
     */
    public function route(
        string $method,
        string $route,
        callable $callback
    ) : void
    {
        $this->routes[] = [
            $route, $method, $callback
        ];
    }

    /**
     * Dispatch the request to the appropriate route.
     * 
     * @return bool Returns true if the route was found and handled, false otherwise.
     */
    public function doRoute() : bool
    {
        $method = $_SERVER[ "REQUEST_METHOD" ] ?? "GET";
        $uri = $_SERVER[ "REQUEST_URI" ] ?? "/";
        $query = $_SERVER[ "QUERY_STRING" ] ?? "";

        //
        // Remove any query params from the URI for matching purposes
        //
        $uri = str_replace( "?" . $query, "", $uri );

        foreach( $this->routes as $route )
        {
            list( $routeUri, $routeMethod, $routeCallback ) = $route;

            //
            // Each route has "?" for a dynamic param. We turn these
            // into a RegEx and check if the current URI is a match.
            //
            $routePattern = preg_replace( "/\?/", "([^/]+)", $routeUri );
            if( preg_match( "#^$routePattern$#", $uri, $matches ) )
            {
                if( $method == $routeMethod )
                {
                    //
                    // Remove the full match from the matches array
                    //
                    array_shift( $matches );

                    call_user_func_array( $routeCallback, $matches );
                    return true;
                }
            }
        }

        return false;
    }
}