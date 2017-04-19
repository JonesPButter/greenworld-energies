<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 19.04.2017
 * Time: 17:33
 */

namespace Source\Models\Helpers\FormValidators\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;

class LowercaseLetter extends AbstractRule {

    public function validate($input) {
        return preg_match("#[a-z]+#", $input);
    }
}