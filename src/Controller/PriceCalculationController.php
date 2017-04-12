<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 31.03.2017
 * Time: 15:09
 */

namespace Source\Controller;


class PriceCalculationController extends AbstractController
{

    public function getPriceCalculator($request, $response)
    {
        return $this->view->render($response, '@tarifhandling/priceCalculatorForm.twig');
    }

    /**
     * This function receives the data, typed in and submitted by the user
     * at the priceCalculatorForm.twig-view.
     */
    public function postCalculatePrice($request, $response)
    {
        die("calculatePrice has to be implemented");
    }
}