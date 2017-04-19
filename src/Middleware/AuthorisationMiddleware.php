<?php

/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 19.04.2017
 * Time: 20:06
 */

namespace Source\Middleware;

class AuthorisationMiddleware extends Middleware
{
    /*
     * Checks if the user is logged in
     */
    public function __invoke($request, $response, $next){

        if(!isset($_SESSION['user'])){
            return $response->withRedirect($this->container->get('router')->pathFor('/userservice/signIn'));
        }
        $response = $next($request, $response);
        return $response;
    }
}