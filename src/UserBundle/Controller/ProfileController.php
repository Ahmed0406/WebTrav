<?php


namespace UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Form\UserCandidatType;
use UserBundle\Form\UserRecruteurType;

class ProfileController extends BaseController
{
    /**
     * Show the user.
     */
    public function showAction()
    {
        $user = $this->getUser();
        $parent_template_var = '';
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if ($user->hasRole('ROLE_CANDIDAT')) {
            $parent_template_var = 'profile/profil-candidat.html.twig';
        } elseif ($user->hasRole('ROLE_RECRUTEUR')) {
            $parent_template_var = 'profile/profil-recuteur.html.twig';
        } else {
            return $this->redirectToRoute('admin');
        }

        return $this->render(':profile:profile.html.twig', array(
            'user' => $user,
            'parent_template_var' => $parent_template_var,
        ));
    }

    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        $view= '';
        $type = '';
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        if ($user->hasRole('ROLE_RECRUTEUR')){
            $type = UserRecruteurType::class;
            $view = ':profile/recruteur_Fn/settings:info.html.twig';
        }

        elseif ($user->hasRole('ROLE_CANDIDAT')){
            $type = UserCandidatType::class;
            $view = ':profile/candidat_Fn/settings:info.html.twig';
        }
        else{
            $this->redirectToRoute('homepage');
        }

        $form = $this->createForm($type,$user, array(
            'mode' => 'info',
        ));
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            return $response;
        }
dump($user);
dump($form);
        return $this->render($view, array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request)
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
        ));
        dump($user);

        $form->setData($user);
        dump($form);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
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
