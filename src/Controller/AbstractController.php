<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 22.11.2016
 * Time: 00:07
 */

namespace Source\Controller;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig;

abstract class AbstractController
{
    protected $view;
    protected $router;

    //Constructor
    public function __construct(Twig $view, RouterInterface $router) {
        $this->view = $view;
        $this->router = $router;
    }
}