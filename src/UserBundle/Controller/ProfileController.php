<?php


namespace UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Entity\Reponse;
use UserBundle\Form\UserCandidatType;
use UserBundle\Form\UserRecruteurType;

class ProfileController extends BaseController
{
    public function showAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $score = null;
        if ($user->hasRole('ROLE_CANDIDAT')) {
            $parent_template_var = 'profile/profil-candidat.html.twig';
            $score = $em->getRepository(Reponse::class)->findByCandidatScore($user->getId());
            dump($score);
        } elseif ($user->hasRole('ROLE_RECRUTEUR')) {
            $parent_template_var = 'profile/profil-recuteur.html.twig';
        }
        elseif ($user->hasRole('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin');
        }else {
            return $this->redirectToRoute('homepage');
        }


        return $this->render(':profile:profile.html.twig', array(
            'user' => $user,
            'parent_template_var' => $parent_template_var,
            'score' => $score,
        ));
    }

    /***
     * @param Request $request
     *
     * @return Response
     */
    public function addProfilCoverImgAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $event = new GetResponseUserEvent($user, $request);
        $form = $this->createForm('UserBundle\Form\UserCandidatType', $user, array(
            'mode' => 'img_cover',
        ));

        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }
            else{
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        return $this->render(':profile/candidat_Fn/settings:img_cover.html.twig', array(
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

        $view = '';
        $type = '';
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        if ($user->hasRole('ROLE_RECRUTEUR')) {
            $type = UserRecruteurType::class;
            $view = ':profile/recruteur_Fn/settings:info.html.twig';
        } elseif ($user->hasRole('ROLE_CANDIDAT')) {
            $type = UserCandidatType::class;
            $view = ':profile/candidat_Fn/settings:info.html.twig';
        } else {
            $this->redirectToRoute('homepage');
        }

        $form = $this->createForm($type, $user, array(
            'mode' => 'info',
        ));
        $form->setData($user);

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
        return $this->render($view, array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}
