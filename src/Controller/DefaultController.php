<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="home")
     */
    public function home()
    {
        return $this->redirectToRoute('easyadmin');
    }

    /**
     * @Route("/test", methods={"GET"}, name="test")
     */
    public function test()
    {
        return $this->render('default/index.html.twig');
    }
}
