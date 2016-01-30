<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class WelcomeController
{
    public function welcomeAction()
    {
        return new Response("Hello World !");
    }
}