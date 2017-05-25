<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        /*$exp = array();
        foreach ($user->getCV()->getExperience() as $ex){
            array_push($exp, $ex);
        }

        foreach ($exp as $e){
            dump($e->getTitre());
        }

        dump($exp);*/
        dump($user);
        return $this->render('app/index.html.twig', [
            'user'=>$user,
        ]);
    }
}
