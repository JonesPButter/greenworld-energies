<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 12.04.2017
 * Time: 13:17
 */

namespace Source\Models\Helpers\FormValidators\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException {

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email is already taken.',
        ],
    ];
}