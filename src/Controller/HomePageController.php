<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Templating;


class HomePageController
{
    /** @var Templating */
    protected $templating;

    /** @param Templating $templating */
    public function __construct(Templating $templating) {
        $this->templating = $templating;
    }

    /**
     * @Route("/", name="home_page")
     */
    public function index(Request $request): Response
    {
        $content = $this->templating->render('home_page/index.html.twig', ['controller_name' => 'HomePageController',]);
        $response = new Response();
        $response->setContent($content);
        return $response;
    }
}
