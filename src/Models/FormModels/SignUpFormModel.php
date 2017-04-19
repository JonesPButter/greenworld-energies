<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 12.04.2017
 * Time: 20:24
 */

namespace Source\Models\FormModels;


class SignUpFormModel extends FormModel {

    private $email;
    private $password;
    private $passwordRetyped;

    /**
     * SignUpFormModel constructor.
     * @param $email
     * @param $password
     * @param $passwordRetyped
     */
    public function __construct($email, $password, $passwordRetyped) {
        parent::__construct([
            "email", "password", "passwordRetyped"
        ]);
        $this->email = $email;
        $this->password = $password;
        $this->passwordRetyped = $passwordRetyped;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPasswordRetyped() {
        return $this->passwordRetyped;
    }

    /**
     * @param mixed $passwordRetyped
     */
    public function setPasswordRetyped($passwordRetyped) {
        $this->passwordRetyped = $passwordRetyped;
    }

    function __toString() {
        return json_encode(get_object_vars($this));
    }


}