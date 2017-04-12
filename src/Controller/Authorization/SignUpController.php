<?php

namespace Source\Controller\Authorization;

use Psr\Http\Message\ResponseInterface;
use Source\Controller\AbstractController;
use Source\Models\Helpers\FormValidators\SignUpFormValidator;

class SignUpController extends AbstractController {

    /**
     * This is the index of the registration process,
     * which shows the registration form.
     */
    public function getRegistration($request,ResponseInterface $response) {
        return $this->view->render($response, '@authorization/signup.twig');
    }

    /**
     * This function receives the data, typed in and submitted by the user
     * at the signup.twig-view.
     */
    public function postRegistration($request,ResponseInterface $response) {
        $v = new SignUpFormValidator($this->userDAO);
        var_dump($v);
        $result = $v->validate($request);
        die("The postRegistration functionality has to be implemented, but valitdation result is: " . var_dump($result));
    }
}