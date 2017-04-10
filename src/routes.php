<?php

/* *********** Create Routes and Connect them with Controllers ***********
 * warning: put the most specific route to the top!
 * Don't forget about the namespaces!
 */

// **************************** ROUTES ****************************

// error-handling
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
    $container = $this->getContainer();
    $this->get("/", function ($request, $response) use ($container) {
        return $response->withRedirect($container->router->pathFor('home'));
    });

    // Login
    $this->get("/login", 'SignInController:getLogin')->setName("signIn");
    $this->post("/login", 'SignInController:postLogin')->setName("signIn.post");

    // Registration
    $this->get("/registration", 'SignUpController:getRegistration')->setName("signUp");
    $this->post("/registration", 'SignUpController:postRegistration')->setName("signUp.post");

    // Price calculator
    $this->get("/calculator", 'PriceCalculationController:getPriceCalculator')->setName("calculator");
    $this->post("/calculator", 'PriceCalculationController:postCalculatePrice')->setName("calculator.post");
 });


// unauthorized Routes - available only for logged in users
$app->group("", function () {

    $this->get("/user/dashboard", 'DashboardController:getDashboard')->setName('dashboard');

    // admin - routes - only the admin should be able to access these routes!
    $this->group("", function(){

    });//->add(new AdminMiddleware($container));

});//->add(new AuthorisationMiddleware($container));
