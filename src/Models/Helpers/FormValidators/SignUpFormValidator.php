<?php

namespace Source\Models\Helpers\FormValidators;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Source\Models\DAOs\UserDAO;

/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 12.04.2017
 * Time: 12:29
 */
class SignUpFormValidator extends JsonFormValidator {

    function __construct(UserDAO $userDAO) {
        parent::__construct($userDAO);
    }

    /**
     * @param $input - FormModel
     * @return bool true, if the FormModel could be validated
     */
    public function validate($input) {
        $result = false;
        if ($this->checkFieldExistence($input,["email", "password", "passwordRetyped"])){
            $emailValidator = Validator::email()->emailAvailable($this->userDAO);
            $passwordValidator = Validator::length(8, 40)
                    ->uppercaseLetter()->lowercaseLetter()
                    ->containsNumber()->equals($input["password"]);
            try{
                $emailValidator->assert($input["email"]);

                try{
                    $passwordValidator->assert($input["passwordRetyped"]);
                    $result = true;
                } catch(NestedValidationException $e){
                    $this->errors["password"] = $e->getMessages();
                }
            } catch(NestedValidationException $e){
                $this->errors["email"] = $e->getMessages();
            }
        }
        return $result;
    }
}