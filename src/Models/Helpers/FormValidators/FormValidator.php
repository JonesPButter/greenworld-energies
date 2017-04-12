<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 12.04.2017
 * Time: 12:46
 */

namespace Source\Models\Helpers\FormValidators;


use Psr\Http\Message\RequestInterface;
use Source\Models\DAOs\UserDAO;

abstract class FormValidator {

    protected $userDAO;

    public function __construct(UserDAO $userDAO){
        $this->userDAO = $userDAO;
    }

    public abstract function validate(RequestInterface $input);
}