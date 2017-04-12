<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 28.03.2017
 * Time: 13:35
 */

namespace Source\Controller\Authorization;


use Source\Controller\AbstractController;

class SignInController extends AbstractController
{
    public function getLogin($request, $response, $args){
        return $this->view->render($response, '@authorization/signIn.twig');
    }

    public function postLogin($request, $response, $args){

        die("Route login.post should be implemented!");
    }
}