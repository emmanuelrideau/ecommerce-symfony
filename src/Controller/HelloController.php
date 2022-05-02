<?php

namespace App\Controller;

use App\Taxes\Calculator;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HelloController
{
    /**
     * @Route("/hello/{prenom?World}", name="hello", methods={"GET", "POST"}, host="localhost", schemes={"http", "https"})
     */
    public function hello($prenom = "World", Environment $twig)
    {

        $html = $twig->render(
            'hello.html.twig',
            [
                'prenom' => $prenom

            ]
        );

        return new Response($html);
    }
}
