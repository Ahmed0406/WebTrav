<?php


namespace UserBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use UserBundle\Entity\Image;
use UserBundle\Entity\UserRecruteur;
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

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }


        $form = $this->createForm(UserRecruteurType::class);
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

        return $this->render('profile/recruteur_Fn/settings/info.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}
