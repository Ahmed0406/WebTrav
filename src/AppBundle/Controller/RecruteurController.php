<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class RecruteurController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function aproposAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render('profile/recruteur_Fn/apropos.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function messagesAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render('profile/recruteur_Fn/messages.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function settingAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render('profile/recruteur_Fn/settings.html.twig', [
            'user' => $user,
        ]);
    }
}