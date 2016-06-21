<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GenusRepository extends EntityRepository
{
    /**
     * @return Genus[]
     */
    public function findAllPublishedOrderedBySize()
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('g.spieciesCout', 'DESC')
            ->getQuery()
            ->execute();
    }
}