<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController 
{
    #[Route("/" , "home")]
    function index (Request $request): Response{
        dd($request);
        return new Response('Bonjour wiam');
    }


}
