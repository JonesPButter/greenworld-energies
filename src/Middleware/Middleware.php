<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 19.04.2017
 * Time: 20:08
 */

namespace Source\Middleware;


class Middleware
{
    protected $container;

    /**
     * Middleware constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }


}