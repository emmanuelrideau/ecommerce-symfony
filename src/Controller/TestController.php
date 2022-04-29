<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController
{
    public function index()
    {
        var_dump("Ca fonctionne");
        die();
    }

    public function test(Request $request)
    {
        $age = $request->attributes->get('age');

        return new Response("Vous avez $age ans");
    }
}
