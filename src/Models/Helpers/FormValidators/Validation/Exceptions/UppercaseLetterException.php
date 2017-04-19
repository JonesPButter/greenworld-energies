<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 19.04.2017
 * Time: 12:36
 */

namespace Source\Models\Helpers\FormValidators\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class UppercaseLetterException extends ValidationException {
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'There is an uppercase letter missing.',
        ],
    ];
}