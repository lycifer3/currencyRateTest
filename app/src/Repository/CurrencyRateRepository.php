<?php

namespace App\Repository;

use App\Dto\CurrencyRateDto;
use App\Entity\CurrencyRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrencyRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyRate[]    findAll()
 * @method CurrencyRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyRate::class);
    }

    /**
     * @throws \Exception
     * @return CurrencyRate[]
     */
    public function findRates(CurrencyRateDto $rateDto): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.currencyExchange', 'c')
            ->where('c.code = :code')
            ->andWhere('r.datetime > :datetime')
            ->setParameters([
                'code' => $rateDto->getCurrency(),
                'datetime' => (new \DateTime())->sub($rateDto->getDateInterval())
            ])
            ->getQuery()
            ->getResult();
    }
}
