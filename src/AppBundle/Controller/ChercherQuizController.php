<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Event\GetResponseUserEvent;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\Reponse;

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
        $serializer = SerializerBuilder::create()->build();

        $requestString = $request->get('q');
        $quiz = $em->getRepository('UserBundle:Quiz')->findEntitiesByString($requestString);

        if (!$quiz) {
            $result['Quiz']['error'] = "aucune recherche trouvé";
        } else {
            $result['Quiz'] = $this->getRealEntities($quiz);
        }


        $response = new Response($serializer->serialize($result, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function getRealEntities($entities)
    {
        $realEntities = array();
        foreach ($entities as $entity) {
            array_push($realEntities, $entity);
        }
        return $realEntities;
    }

    /**
     *
     * @Route("/quiz/{id}", name="quiz_show")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function showQuizAction(Request $request, $id)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $event = new GetResponseUserEvent($user, $request);

        $quiz = $em->getRepository('UserBundle:Quiz')->find($id);

        $question = array();
        foreach ($quiz->getQuestion() as $qz) {
            array_push($question, $qz);
        }

        $form = $this->createFormBuilder()
            // ...
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponce = new Reponse();

            $rep = $request->request->all();
            $q = $this->validation($rep, $id);

            $reponce->setQuiz($quiz);
            $reponce->setUserCandidat($user);
            $reponce->setSuccess($q);
            $reponce->setDate(new \DateTime());
            $em->persist($reponce);
            $em->flush();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }
            return $response;
        }


        return $this->render(':profile/candidat_Fn/quiz:show.html.twig', array(
            'user' => $user,
            'quiz' => $quiz,
            'question' => $question,
            'form' => $form->createView(),
        ));

    }

    public function validation($reponce, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $qestion = $em->getRepository('UserBundle:Question')->findByQuiz($id);

        $rs = array();
        foreach ($reponce as $r) {
            array_push($rs, $r);
        }

        $qs = array();
        foreach ($qestion as $q) {
            foreach ($q as $qq) {
                array_push($qs, $qq);
            }
        }


        $r = false;
        for ($i = 0; $i < count($qs); $i++) {
            if ($qs[$i] != $rs[$i]) {
                $r = false;
                break;
            } else {
                $r = true;
            }
        }

        return $r;
    }

    /**
     *
     * @Route("/quiz/", name="quiz_check")
     * @param Request $request
     * @return Response
     */
    public function checkQuizAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->redirectToRoute('homepage');

    }
}
