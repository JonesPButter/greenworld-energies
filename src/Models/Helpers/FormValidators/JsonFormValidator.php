<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 12.04.2017
 * Time: 12:46
 */

namespace Source\Models\Helpers\FormValidators;


use Source\Models\DAOs\UserDAO;

abstract class JsonFormValidator {

    protected $userDAO;
    protected $errors;

    public function __construct(UserDAO $userDAO){
        $this->userDAO = $userDAO;
        $this->errors = array();
    }

    public abstract function validate($data);

    protected function checkFieldExistence($data, $fieldNames){
        $exist = true;
        foreach($fieldNames as $name){
            if(!isset($data[$name])){
                $this->errors[$name] = "The field " . $name . " is missing.";
                $exist = false;
            }
        }
        return $exist;
    }

    public function getErrors(){
        return $this->errors;
    }
}