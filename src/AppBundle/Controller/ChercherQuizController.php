<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ChercherQuizController extends Controller
{
    public function showAction()
    {
        return $this->render(':profile/candidat_Fn/quiz:search.html.twig', array());
    }

    /**
     *
     * @Route("/search", name="ajax_search")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request)
    {
        /*$user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }*/

        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $entities  = $em->getRepository('UserBundle:Quiz')->findAll();

        if(!$entities) {
            $result['Quiz']['error'] = "aucune recherche trouvé";
        } else {
            $result['Quiz'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($entities){
        $realEntities = array();
        foreach ($entities as $entity){
            array_push($realEntities,$entity);
        }
        return $realEntities;
    }
}
