<?php

namespace LudovicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CountryController extends Controller
{
  /**
   * @Route("/countries", name="ludovic_country_all")
   */
  public function showAction()
  {
    return $this->render('base.html.twig');
  }
}