<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     */
    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render('app/index.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/apropos", name="apropos")
     * @return Response
     * @internal param Request $request
     */
    public function aproposAction()
    {
        $user = $this->getUser();
        return $this->render('app/apropos.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/recherche", name="recherche")
     * @return Response
     * @internal param Request $request
     */
    public function rechercheAction()
    {
        $user = $this->getUser();

        if ($user->hasRole('ROLE_CANDIDAT')) {
            $parent_template_var = 'profile/candidat_Fn/recherche.html.twig';
        } elseif ($user->hasRole('ROLE_RECRUTEUR')) {
            $parent_template_var = 'profile/recruteur_Fn/recherche.html.twig';
        } else {
            return $this->redirectToRoute('homepage');
        }

        return $this->render($parent_template_var, [
            'user' => $user,
        ]);
    }
}
