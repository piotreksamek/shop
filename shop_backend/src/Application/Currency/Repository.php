<?php

namespace App\Application\Currency;

use App\Data\Entity\Currency\Currency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    public function save(Currency $currency): void
    {
        $em = $this->getEntityManager();

        $em->persist($currency);
        $em->flush();
    }
}
