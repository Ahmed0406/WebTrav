<?php

namespace AppBundle\Controller;


use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Form\UserRecruteurType;

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



    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addAproposAction(Request $request)
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


        $form = $this->createForm(UserRecruteurType::class, $user, array(
            'mode' => 'apropos',
            'action' => $this->generateUrl('add_apropos'),
            'method' => 'POST',
        ));
        dump($user);

        $form->setData($user);
        dump($form);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        return $this->render('profile/recruteur_Fn/apropos/add.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}