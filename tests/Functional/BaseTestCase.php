<?php
namespace Tests\Functional;

//session_start(); // Important
# running from the cli doesn't set $_SESSION here on phpunit trunk
if ( !isset( $_SESSION ) ) $_SESSION = array(  );
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Psr\Http\Message\ResponseInterface;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return ResponseInterface
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // *********** Require Autoloading for making all classes available ***********
        require __DIR__ . '/../../vendor/autoload.php';

        // *********** Instantiate the app ***********
        $settings = require __DIR__ . '/../../src/settings.php';
        $app = new App($settings);

        // *********** Set up dependencies ***********
        require __DIR__ . '/../../src/dependencies.php';

        // *********** Register middleware ***********
        require __DIR__ . '/../../src/middleware.php';

        // *********** Register routes ***********
        require __DIR__ . '/../../src/routes.php';

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
