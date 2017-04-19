<?php

/* *********** Create Routes and Connect them with Controllers ***********
 * warning: put the most specific route to the top!
 * Don't forget about the namespaces!
 */

// **************************** ROUTES ****************************

// error-handling
use Source\Middleware\AuthorisationMiddleware;

$app->get("/unauthorized", function($request, $response) use($container){
    return $container->get('view')->render($response, '@views/unauthorizedPage.twig');
})->setName("unauthorized");

$app->get("/error", function($request, $response) use($container){
    return $container->get('view')->render($response, '@views/errorPage.twig');
})->setName("unauthorized");

// authorized Routes (public)
$app->group("", function () {

    // ************** Homepage - Routes **************
    // Get the Homepage
    $this->get("/home", 'HomeController:index')->setName("home");
    // Redirect to Homepage
    $this->get("/", 'HomeController:redirect');

    // Price calculator
    $this->get("/calculator", 'PriceCalculationController:getPriceCalculator')->setName("calculator");
    $this->post("/calculator", 'PriceCalculationController:postCalculatePrice')->setName("calculator.post");

    $this->group("/userservice", function(){
        // Login
        $this->get("/login", 'SignInController:getLogin')->setName("/userservice/signIn");
        $this->post("/login", 'SignInController:postLogin')->setName("/userservice/signIn.post");

        // Registration
        $this->get("/registration", 'SignUpController:getRegistration')->setName("/userservice/signUp");
        $this->post("/registration", 'SignUpController:postRegistration')->setName("/userservice/signUp.post");
    });

});


// unauthorized Routes - available only for logged in users
$app->group("", function () {

    $this->group("/userservice/dashboard", function(){
        $this->get("", 'DashboardController:redirect');
        $this->get("/", 'DashboardController:redirect')->setName('/dashboard');
        $this->get("/overview", 'DashboardController:getOverviewPage')->setName('/dashboard/overview');
        $this->get("/data", 'DashboardController:getDataPage')->setName('/dashboard/data');
        $this->get("/meter", 'DashboardController:getMeterPage')->setName('/dashboard/meter');
    });

    // admin - routes - only the admin should be able to access these routes!
    $this->group("", function(){

    });//->add(new AdminMiddleware($container));

});//->add(new AuthorisationMiddleware($container));
