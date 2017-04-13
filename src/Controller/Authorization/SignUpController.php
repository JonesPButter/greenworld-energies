<?php

namespace Source\Controller\Authorization;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Source\Controller\AbstractController;
use Source\Models\FormModels\SignUpFormModel;
use Source\Models\Helpers\FormValidators\SignUpFormValidator;

class SignUpController extends AbstractController {

    /**
     * This is the index of the registration process,
     * which shows the registration signUpForm.
     */
    public function getRegistration($request,ResponseInterface $response) {
        return $this->view->render($response, '@authorization/signup.twig');
    }

    /**
     * This function receives the data, typed in and submitted by the user
     * at the signup.twig-view.
     */
    public function postRegistration(RequestInterface $request,ResponseInterface $response) {
//        $v = new SignUpFormValidator($this->userDAO);
        ob_start();
        $formModel = new SignUpFormModel("test", "hasd", "hssd");

//        $result = $this->serializer->deserialize($request->getParsedBody(),SignUpFormModel::class,"json");
//        var_dump($result);
        var_dump($request->getParsedBody());
        $output = ob_get_clean();
        $this->logger->info($output);
        die("The postRegistration functionality has to be implemented, but valitdation result is: ");
    }
}