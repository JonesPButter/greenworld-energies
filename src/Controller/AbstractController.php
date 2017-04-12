<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 22.11.2016
 * Time: 00:07
 */

namespace Source\Controller;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig;
use Source\Models\DAOs\UserDAO;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractController
{
    /** @var Twig */
    protected $view;
    /** @var RouterInterface */
    protected $router;
    /** @var UserDAO */
    protected $userDAO;
    /** @var Logger */
    protected $logger;
    /** @var Serializer */
    protected $serializer;

    //Constructor
    public function __construct(ContainerInterface $container) {
        $this->view = $container->get("view");
        $this->router = $container->get("router");
        $this->userDAO = $container->get("userDAO");
        $this->logger = $container->get("logger");
        $this->serializer = $container->get("serializer");
    }
}