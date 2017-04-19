<?php

namespace Source\Controller\Authorization;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Source\Controller\AbstractController;
use Source\Models\Helpers\ApiResponse;
use Source\Models\Helpers\FormValidators\SignUpFormValidator;

class SignUpController extends AbstractController {

    /**
     * This is the index of the registration process,
     * which shows the registration signUpForm.
     */
    public function getRegistration($request, ResponseInterface $response) {
        return $this->view->render($response, '@authorization/signup.twig');
    }

    /**
     * This function receives the data, typed in and submitted by the user
     * at the signup.twig-view.
     */
    public function postRegistration(RequestInterface $request,$response) {
        $jsonArray = json_decode($request->getBody(), true);
        $v = new SignUpFormValidator($this->userDAO);
        if (!$v->validate($jsonArray)) {
            return $response->withJson($v->getErrors(),405);
        } else{
            $password = password_hash($jsonArray["password"], PASSWORD_DEFAULT);
            $id = $this->userDAO->createUser($jsonArray['email'],$password,"user",null);
            $redirect = array('redirect' => $this->router->pathFor("home"));
            return $response->withJson($redirect, 303);
        }
    }
}