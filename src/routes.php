<?php

/* *********** Create Routes and Connect them with Controllers ***********
 * warning: put the most specific route to the top!
 * Don't forget about the namespaces!
 */
use \Source\Middleware\AdminMiddleware;
use \Source\Middleware\AuthorizedMiddleware;
use \Source\Middleware\ClientCertificateMiddleware;

// **************************** ROUTES ****************************

// error-handling
$app->get("/unauthorized", function($request, $response) use($container){
    return $container->get('view')->render($response, '@views/unauthorizedPage.twig');
})->setName("unauthorized");

$app->get("/error", function($request, $response) use($container){
    return $container->get('view')->render($response, '@views/errorPage.twig');
})->setName("unauthorized");

// Unauthorized Routes (public)
$app->group("", function () {

    // ************** Homepage - Routes **************
    // Get the Homepage
    $this->get("/home", 'HomeController:index')->setName("home");

    // Redirect to Homepage
    $container = $this->getContainer();
    $this->get("/", function ($request, $response) use ($container) {
        return $response->withRedirect($container->router->pathFor('home'));
    });

    // Login
    $this->get("/login", 'LoginController:getLogin')->setName("login");
    $this->post("/login", 'LoginController:postLogin')->setName("login.post");

    // Registration
    $this->get("/registration", 'RegistrationController:getRegistration')->setName("registration");
    $this->post("/registration", 'RegistrationController:postRegistration')->setName("registration.post");

    // Price calculator
    $this->get("/calculator", 'PriceCalculationController:getPriceCalculator')->setName("calculator");
    $this->post("/calculator", 'PriceCalculationController:postCalculatePrice')->setName("calculator.post");
 });


// authorized Routes - available only for logged in users
$app->group("", function () {
    $container = $this->getContainer();

    // admin - routes - only the admin should be able to access these routes!
    $this->group("", function(){

    });//->add(new AdminMiddleware($container));

});//->add(new AuthorizedMiddleware($container));
