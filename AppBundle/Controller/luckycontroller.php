<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of luckycontroller
 *
 * @author Gerd
 */

// src/AppBundle/Controller/LuckyController.php
//namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response; //Deze voegt een stuk html pagina codering aan toe.

class LuckyController
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);
        return '<p>Lucky number: '.$number.'</p>';
        //return new Response(
        //    '<p>Lucky number: '.$number.'</p>'
        //);
    }
}