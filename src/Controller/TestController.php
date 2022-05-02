<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        var_dump("Ca fonctionne");
        die();
    }

    /**
     * @Route("/test/{age?0}", name="test", methods={"GET", "POST"}, host="localhost", schemes={"http", "https"})
     */
    public function test(Request $request)
    {
        $age = $request->attributes->get('age');

        return new Response("Vous avez $age ans");
    }
}
