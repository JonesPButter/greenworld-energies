<?php

/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 21.11.2016
 * Time: 10:50
 */
namespace Source\Models;
//use Illuminate\Database\Eloquent\Model;

/*
 * The User Class is already connected with the "users"-Table in the Database
 */
class Customer
{
    private $id;
    private $user; //
    private $gender;
    private $title;
    private $forename;
    private $familyname;
    private $birthday;
    private $telephoneNr;
    private $created_at;
    private $updated_at;
    private $type;

    /**
     * User constructor.
     * @param $user User - the user object that is related to this customer
     * @param $gender - man or woman
     * @param $title - the title of the customer
     * @param $forename - the forename
     * @param $familyname - the familyname
     * @param $birthday - the birthday (yyyy-mm-dd)
     * @param $telephoneNr - the telephone nr.
     * @param $type - the customers type (for example "private")
     */
    public function __construct(User $user, $gender, $title, $forename, $familyname, $birthday, $telephoneNr, $type) {
        $this->user = $user;
        $this->gender = $gender;
        $this->title = $title;
        $this->forename = $forename;
        $this->familyname = $familyname;
        $this->birthday = $birthday;
        $this->telephoneNr = $telephoneNr;
        $this->type = $type;
        $this->created_at = date('Y-m-d');
        $this->updated_at = date('Y-m-d');
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
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender) {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getForename() {
        return $this->forename;
    }

    /**
     * @param mixed $forename
     */
    public function setForename($forename) {
        $this->forename = $forename;
    }

    /**
     * @return mixed
     */
    public function getFamilyname() {
        return $this->familyname;
    }

    /**
     * @param mixed $familyname
     */
    public function setFamilyname($familyname) {
        $this->familyname = $familyname;
    }

    /**
     * @return mixed
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getTelephoneNr() {
        return $this->telephoneNr;
    }

    /**
     * @param mixed $telephoneNr
     */
    public function setTelephoneNr($telephoneNr) {
        $this->telephoneNr = $telephoneNr;
    }

    /**
     * @return false|string
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * @param false|string $created_at
     */
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    /**
     * @return false|string
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    /**
     * @param false|string $updated_at
     */
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    public function to_json(){
        return json_encode(get_object_vars($this));
    }

}