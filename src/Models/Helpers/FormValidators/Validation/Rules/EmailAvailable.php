<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 12.04.2017
 * Time: 13:15
 */

namespace Source\Models\Helpers\FormValidators\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;
use Source\Models\DAOs\UserDAO;

class EmailAvailable extends AbstractRule {

    private $dao;

    public function __construct(UserDAO $dao){
        $this->dao = $dao;
    }

    public function validate($input){
        $user = $this->dao->getUserByEmail($input);
        return !isset($user);
    }
}