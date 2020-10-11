<?php

namespace App\Repository;

use App\Entity\Mood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mood|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mood|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mood[]    findAll()
 * @method Mood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Mood::class);
        $this->em = $em;
    }


    /**
     * methode pour changer le mood de l'utilisateur
     */
    public function updateMood($id_util, $mood) {

        $qb = $this->em->createQueryBuilder();
        $q = $qb->update(Mood::class, 'm')
            ->set('m.mooduser', '?1')
            ->where('m.iduser = ?2')
            ->setParameter(1, $mood)
            ->setParameter(2, $id_util)
            ->getQuery();
        $result = $q->execute();
        if($result) {
            return true;
        } else {
            return false;
        }

    }





    // /**
    //  * @return Mood[] Returns an array of Mood objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mood
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
