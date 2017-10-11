<?php

namespace LudovicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SportController extends Controller
{
  /**
   * @Route("/sports", name="ludovic_sport_all")
   */
  public function showAction()
  {
    return $this->render('base.html.twig');
  }
}