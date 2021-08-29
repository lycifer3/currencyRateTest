<?php

namespace App\Repository;

use App\Entity\Currency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use \Doctrine\ORM\NonUniqueResultException;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends ServiceEntityRepository
{
    const BASE_CURRENCY = 'BTC';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneByCode($value): ?Currency
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.code = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllExchanges(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.code != :val')
            ->setParameter('val', self::BASE_CURRENCY)
            ->getQuery()
            ->getResult();
    }
}
