<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ConfirmationController extends AbstractController
{
    public function showConfirmation(): Response
    {
        return $this->render('confirmation/index.html.twig');
    }
}
