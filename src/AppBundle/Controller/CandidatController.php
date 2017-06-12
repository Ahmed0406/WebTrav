<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\CV;
use UserBundle\Entity\Experience;
use UserBundle\Entity\Formation;
use UserBundle\Entity\Projet;
use UserBundle\Form\ExperienceType;
use UserBundle\Form\FormationType;
use UserBundle\Form\ProjetType;

class CandidatController extends Controller
{
    /*-------------------------------------showCV-----------------------------------------*/

    public function showCVAction()
    {
        $user = $this->getUser();
        return $this->render(':profile/candidat_Fn/cv:cv.html.twig', array(
            'user' => $user,
        ));
    }

    public function showCVExperienceAction()
    {
        $user = $this->getUser();
        $experience = array();
        if ($user->getCV()) {
            foreach ($user->getCV()->getExperience() as $ex) {
                array_push($experience, $ex);
            }
        }

        return $this->render(':profile/candidat_Fn/cv/experiences:show.html.twig', array(
            'user' => $user,
            'experience' => $experience,
        ));
    }

    public function showCVFormationAction()
    {
        $user = $this->getUser();
        $formation = array();
        if ($user->getCV()) {
            foreach ($user->getCV()->getFormation() as $ex) {
                array_push($formation, $ex);
            }
        }
        return $this->render(':profile/candidat_Fn/cv/formations:show.html.twig', array(
            'user' => $user,
            'formation' => $formation,
        ));
    }

    public function showCVProjetAction()
    {
        $user = $this->getUser();
        $projet = array();
        if ($user->getCV()) {
            foreach ($user->getCV()->getProjet() as $ex) {
                array_push($projet, $ex);
            }
        }
        return $this->render(':profile/candidat_Fn/cv/projets:show.html.twig', array(
            'user' => $user,
            'projet' => $projet,
        ));
    }


    /*----------------------------------addCV-----------------------------------------*/

    public function addCVAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if ($user->getCV() == null) {
            $cv = new CV();
            $cv->setUserCandidat($user);
            $user->setCV($cv);

            dump($cv);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render(':profile/candidat_Fn/cv:add.html.twig', array(
            'user' => $user,
        ));
    }


    /**
     *  addCVExperience.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addCVExperienceAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $ex = new Experience();
        $cv = $user->getCV();
        $ex->setCV($cv);


        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm(ExperienceType::class, $ex);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ex);
            $em->flush();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        return $this->render(':profile/candidat_Fn/cv/experiences:add.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }


    /**
     *  addCVFormation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addCVFormationAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $frm = new Formation();
        $cv = $user->getCV();
        $frm->setCV($cv);

        $form = $this->createForm(FormationType::class, $frm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($frm);
            $em->flush();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        return $this->render(':profile/candidat_Fn/cv/formations:add.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }


    /**
     *  addCVProjet.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addCVProjetAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $pro = new Projet();
        $cv = $user->getCV();
        $pro->setCV($cv);

        $form = $this->createForm(ProjetType::class, $pro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pro);
            $em->flush();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        return $this->render(':profile/candidat_Fn/cv/projets:add.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}
