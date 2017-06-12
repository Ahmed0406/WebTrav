<?php

namespace AppBundle\Controller;

use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UserBundle\Entity\Reponse;
use UserBundle\Entity\UserCandidat;

class RechercheRecruteurController extends Controller
{
    /**
     * @Route("/chercher_candidat", name="chercher_candidat")
     * @param Request $request
     * @return Response
     */
    public function chercherCandidatAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serializer = SerializerBuilder::create()->build();

        $requestString = $request->get('q');
        $Candidat = $em->getRepository(UserCandidat::class)->findCdnByDomaine($requestString);
        $Reponse = $em->getRepository(Reponse::class)->findByCandidat($Candidat);

        $result = $this->chercherCandidat($Candidat, $Reponse);

        $response = new Response($serializer->serialize($result, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    protected function chercherCandidat($Candidat, $Reponse)
    {
        $return = array();
        foreach ($Candidat as $cdn) {
//            dump($cdn);
            foreach ($Reponse as $rep) {
                foreach ($rep as $re) {
                    if ($re->getSuccess() == true && $re->getUserCandidat() == $cdn){
                        array_push($return,$cdn);
                    }
                }
            }
        }
        return $return;

    }
}
