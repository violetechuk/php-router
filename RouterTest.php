<?php
/**
 * PHP Router (Test)
 * 
 * @license MIT License (https://opensource.org/licenses/MIT)
 * @author Violetech (https://www.violetech.co.uk)
 */

require_once( __DIR__ . "/Router.php" );

$router = new Violetech\SimpleRouter();
$router->route(
    "GET",
    "/",
    function()
    {
        echo "Home page.";
    }
);
$router->route(
    "GET",
    "/hello",
    function()
    {
        echo "Hello, World!";
    }
);
$router->route(
    "POST",
    "/hello",
    function()
    {
        echo "Hello, World but with POST!";
    }
);
$router->route(
    "GET",
    "/hello/?",
    function( string $p )
    {
        echo "Hello, World. Param was $p.";
    }
);

if( !$router->doRoute() )
{
    http_response_code( 404 );
    die( "404 Not Found" );
}