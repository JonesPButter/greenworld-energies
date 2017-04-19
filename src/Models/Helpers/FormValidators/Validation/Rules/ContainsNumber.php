<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 19.04.2017
 * Time: 12:33
 */

namespace Source\Models\Helpers\FormValidators\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;

class ContainsNumber extends AbstractRule {

    public function validate($input) {
        return preg_match("#[0-9]+#", $input);
    }
}