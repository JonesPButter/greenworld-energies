<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 19.04.2017
 * Time: 17:34
 */

namespace Source\Models\Helpers\FormValidators\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class LowercaseLetterException extends ValidationException {
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => "There is a lowercase letter missing.",
        ],
    ];
}