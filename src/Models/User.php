<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 01.04.2017
 * Time: 17:32
 */

namespace Source\Models;


class User {

    private $id;
    private $email;
    private $password;
    private $role;
    private $token;
    private $verified;
    private $created_at;
    private $updated_at;

    /**
     * User constructor.
     * @param $id
     * @param $email
     * @param $password
     * @param $role
     * @param $verified
     * @param $created_at
     * @param $updated_at
     */
    public function __construct($id, $email, $password, $role, $token, $verified, $created_at, $updated_at) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->token = $token;
        $this->verified = $verified;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
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
    public function getRole() {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getToken(){
        return $this->token;
    }

    /**
     * @param $token
     */
    public function setToken($token){
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function isVerified() {
        return $this->verified;
    }

    /**
     * @param mixed $verified
     */
    public function setVerified($verified) {
        $this->verified = $verified;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function toJson(){
        return json_encode(get_object_vars($this));
    }
}