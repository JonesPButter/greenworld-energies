<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 10.04.2017
 * Time: 17:02
 */

namespace Source\Controller;


use Psr\Http\Message\ResponseInterface;

class DashboardController extends AbstractController {

    public function redirect($request,ResponseInterface $response){
        return $response->withRedirect($this->router->pathFor('/dashboard/overview'));
    }

    public function getOverviewPage($request, $response) {
        return $this->view->render($response, '@dashboard/dashboardOverview.twig');
    }

    public function getDataPage($request, $response) {
        return $this->view->render($response, '@dashboard/dashboardUserData.twig');
    }

    public function getMeterPage($request, $response) {
        return $this->view->render($response, '@dashboard/dashboardMeterReading.twig');
    }
}