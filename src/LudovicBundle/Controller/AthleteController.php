<?php

namespace LudovicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AthleteController extends Controller
{
  /**
   * @Route("/athletes", name="ludovic_athlete_all")
   */
  public function showAction()
  {
    return $this->render('base.html.twig');
  }
}
