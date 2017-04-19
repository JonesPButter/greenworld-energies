<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 19.04.2017
 * Time: 12:41
 */

namespace Source\Models\Helpers\FormValidators\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class ContainsNumberException extends ValidationException {
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'A number is missing.',
        ],
    ];
}