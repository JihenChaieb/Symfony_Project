<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  FormationController extends AbstractController
{
    /**
     * @Route("/formation/master", name="master")
     */
    public function master(): Response
    {
        return $this->render('page/master-left.html.twig');
    }
    /**
     * @Route("/formation/licence", name="licence")
     */
    public function licence(): Response
    {
        return $this->render('page/Licence-right.html.twig');
    }
    /**
     * @Route("/formation/btp_bts", name="btp_bts")
     */
    public function formations(): Response
    {
        return $this->render('page/btp_bts.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig');
    }
}
