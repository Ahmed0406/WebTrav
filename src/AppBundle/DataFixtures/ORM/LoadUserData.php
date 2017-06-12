<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $userManager
     */
    public function load(ObjectManager $userManager)
    {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $userManager = $this->container->get('pugx_user_manager');

        // Create a new user
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.ad');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_ADMIN']);
        $userManager->updateUser($user, true);

        // Create a new UserCandidat
        $discriminator->setClass('UserBundle\Entity\UserCandidat');
        $user = $userManager->createUser();
        $user->setUsername('cdn');
        $user->setEmail('cdn@cdn.ad');
        $user->setPlainPassword('cdn');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_CANDIDAT']);
        $userManager->updateUser($user, true);

        // Create a new UserRecruteur
        $discriminator->setClass('UserBundle\Entity\UserRecruteur');
        $user = $userManager->createUser();
        $user->setUsername('rec');
        $user->setEmail('rec@rec.ad');
        $user->setPlainPassword('rec');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_RECRUTEUR']);
        $userManager->updateUser($user, true);
    }
}