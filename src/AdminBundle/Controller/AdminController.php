<?php

namespace AdminBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseController;

class AdminController extends BaseController
{
    /**
     * @Route("/", name="easyadmin")
     * @Route("/", name="admin")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $quiz = $em->getRepository('UserBundle:Quiz')->findAll();
        dump($quiz);

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if (!$user->hasRole('ROLE_ADMIN')) {
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return parent::indexAction($request);
    }

    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

}
