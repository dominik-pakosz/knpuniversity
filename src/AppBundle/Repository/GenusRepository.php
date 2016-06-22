<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GenusRepository extends EntityRepository
{
    /**
     * @return Genus[]
     */
    public function findAllPublishedOrderedByRecentlyActive()
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->leftJoin('g.notes', 'g_n')
            ->orderBy('g_n.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }
}