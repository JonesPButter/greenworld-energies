<?php

namespace Source\Models\Helpers\FormValidators;
use Psr\Http\Message\RequestInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 12.04.2017
 * Time: 12:29
 */
class SignUpFormValidator extends FormValidator {

    /**
     * @param $input - FormModel
     * @return bool true, if the FormModel could be validated
     */
    public function validate(RequestInterface $input){
        $result = false;
        $emailValidator = Validator::alnum()->emailAvailable($this->userDAO);
        $passwordValidator = Validator::length(8,40)->equals($input->getParam('passwordRetyped'));
        try{
            $result = $emailValidator->validate($input->getParam('email'))
                && $passwordValidator->validate($input->getParam('password'));
        } catch(NestedValidationException $e){
            $_SESSION['errors'] = $e;
        }
        return $result;
    }
}