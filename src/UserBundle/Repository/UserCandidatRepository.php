<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserCandidatRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class UserCandidatRepository extends EntityRepository
{
    public function findCdnByDomaine($requestString)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT cdn
                FROM UserBundle:UserCandidat cdn
                WHERE cdn.domaine LIKE :str'
            )
            ->setParameter('str', array('%' . $requestString . '%'))
            ->getResult();

    }
}
