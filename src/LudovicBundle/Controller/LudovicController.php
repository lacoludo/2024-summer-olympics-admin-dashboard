<?php

namespace LudovicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LudovicController extends Controller
{
  /**
   * @Route("/ludovic", name="app_ludovic_show")
   */
  public function showAction()
  {
    return $this->render('base.html.twig');
  }
}
