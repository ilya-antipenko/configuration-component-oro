<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        dump([
            'presenter_first_name' => $this->getParameter('presenter_first_name'),
            'presenter_last_name' => $this->getParameter('presenter_last_name'),
            'company' => $this->getParameter('presenter_company'),
        ]);

        return new Response();
    }
}
