<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $configurationProvider = $this->get('contributors.configuration.provider');
        $config = $configurationProvider->load('Resources/config/contributors.yml');

        dump($config);

        return new Response();
    }
}
