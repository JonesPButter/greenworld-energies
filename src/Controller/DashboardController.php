<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 10.04.2017
 * Time: 17:02
 */

namespace Source\Controller;


class DashboardController extends AbstractController {

    public function getDashboard($request, $response){
        return $this->view->render($response, '@views/dashboard.twig');
    }
}