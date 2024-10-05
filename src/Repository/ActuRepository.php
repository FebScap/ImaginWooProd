<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Repository;

use App\Entity\Actu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Actu>
 */
class ActuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actu::class);
    }

    /**
     * @param $year int Of the year searched
     * @return Actu[] Returns an array of Actu objects
     */
    public function findByYear(int $year): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere("a.year = :year")
            ->setParameter('year', $year)
            ->orderBy('a.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array|int All years existing in DB
     */
    public function getAllYears(): array|int
    {
        return $this->createQueryBuilder('a')
            ->select('a.year')
            ->distinct()
            ->orderBy('a.year', 'ASC')
            ->getQuery()
            ->getSingleColumnResult();
    }
}
