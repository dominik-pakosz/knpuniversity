<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;

class GenusNoteRepository extends EntityRepository
{
    /**
     * @param Genus $genus
     * @return GenusNote[]
     */
    public function findAllRecentNotesForGenus(Genus $genus)
    {
        return $this->createQueryBuilder('g_n')
            ->andWhere('g_n.genus = :genus')
            ->setParameter('genus', $genus)
            ->andWhere('g_n.createdAt > :date')
            ->setParameter('date', new \DateTime('-3 months'))
            ->getQuery()
            ->execute();
    }
}