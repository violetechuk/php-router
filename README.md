# PHP Router
A simple, one-file PHP router. Download `Router.php` and `require_once` it to get started!

## Usage
The best example can be found in `RouterTest.php`. Here's a simple usage example:

```PHP
require_once( __DIR__ . "/Router.php" );
$router = new Violetech\SimpleRouter();
$router->route(
	"GET",
	"/example",
	function()
	{
	    echo "Example page output.";
	}
);
$router->route(
	"GET",
	"/example/?",
	function( string $param )
	{
	    echo "Example page output with param: $param";
	}
);
if( !$router->doRoute() )
{
    echo "404 Not Found";
}
```

`Router::route()` adds a route, with a method, path and callback to execute when the route and method matches. `Router::doRoute()` performs the actual routing and returns a boolean that tells you if it succeeded finding a route and executing it or not.

A `?` character in the path indicates a wildcard that can contain anything up until the next `/`, and their values will be passed to the callback's parameters for you to use as you wish.