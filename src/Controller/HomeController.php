<?php
/**
 * Created by PhpStorm.
 * User: Jones
 * Date: 22.11.2016
 * Time: 00:06
 */

namespace Source\Controller;

use \Psr\Http\Message\ResponseInterface;

class HomeController extends AbstractController {
    public function index($request, ResponseInterface $response, $args) {
        return $this->view->render($response, '@views/home.twig');
    }

    public function redirect($request,ResponseInterface $response){
        return $response->withRedirect($this->router->pathFor('home'));
    }
}