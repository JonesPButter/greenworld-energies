<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 18.04.2017
 * Time: 17:45
 */

namespace Source\Models\FormModels;


abstract class FormModel {

    protected $fieldNames;

    function __construct($fieldNames) {
        $this->fieldNames = $fieldNames;
    }

    public function getFieldNames(){
        return $this->fieldNames;
    }
}