<?php

namespace AppBundle\Controller;

use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\Reponse;

class ReponceQuizController extends Controller
{
    /**
     *
     * @Route("/reponce/all", name="all_reponce_quiz")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function allAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $serializer = SerializerBuilder::create()->build();

        $result = $em->getRepository(Reponse::class)->findAll();

        $response = new Response($serializer->serialize($result, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     *
     * @Route("/reponce/etapes", name="reponce_etapes")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function reponceAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $response = null;

        $em = $this->getDoctrine()->getManager();
        $serializer = SerializerBuilder::create()->build();

        $result = $em->getRepository(Reponse::class)->findByCandidatEtaps($user->getId());

        $response = new Response($serializer->serialize($result, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
