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
        $jsonArray = json_decode($request->getBody(), true);
        $verified = $this->auth->signIn($jsonArray['email'], $jsonArray['password']);
        if(!$verified){
            return $response->withJson(array("error:" => "Password or Email is invalid."),405);
        } else{
            $redirect = array('redirect' => $this->router->pathFor("/dashboard"));
            return $response->withJson($redirect, 303);
        }
    }
}