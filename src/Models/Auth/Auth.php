<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 29.11.2016
 * Time: 14:00
 */

namespace Source\Models\Auth;


use Source\Models\DAOs\UserDAO;

/**
 * Class Auth
 *
 * A basic Authorization class, which is checking the clients credentials and
 * which is setting/unsetting the sesseion variable.
 *
 * @package Source\Models\Auth
 */
class Auth
{
    /** @var UserDAO  */
    protected $userDAO;

    //Constructor
    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    /**
     * @param $email
     * @param $password
     * @return bool true, if user could be signed in
     */
    public function signIn($email, $password){
        $user = $this->userDAO->getUserByEmail($email);
        if(isset($user)){
            if(password_verify($password,$user->getPassword()) && $user->isVerified()){
                $_SESSION['user'] = $user->getId();
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool True if the Session Variable is set
     */
    public function isUserLoggedIn(){
        return isset($_SESSION['user']);
    }

    /**
     * @return null|\Source\Models\User - The current User
     */
    public function getUser(){
        $user = null;
        if(isset($_SESSION['user'])){
            $user = $this->userDAO->getUserByID($_SESSION['user']);
        }
        return $user;
    }

    /**
     * Destroys the session
     */
    public function logout(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
    }
}