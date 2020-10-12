<?php

namespace App\Repository;

use App\Entity\Mood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

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
     * @param $id_util
     * @param $mood
     * @return bool
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

    /**
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getIdColumn(): array {

        $id_column_sad = (int)$this->getCountUser('sad');
        $id_column_happy = (int)$this->getCountUser('happy');

        $column_id = [
            "sad" => $id_column_sad,
            "happy" => $id_column_sad+2,
            "very happy" => $id_column_sad+$id_column_happy+3
        ];

        return $column_id;
    }

    /**
     * @return array
     */
    public function getAllUserByMood():array {

        return array(
            "sad" => $this->selectUser('sad'),
            "happy" => $this->selectUser('happy'),
            "very happy" => $this->selectUser('very happy')
        );
    }

    /**
     * @param $mood
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getCountUser($mood) {

        $qb = $this->em->createQueryBuilder();
        return $qb->select('COUNT(m.id)')
            ->from(Mood::class, 'm')
            ->where('m.mooduser = ?1')
            ->setParameter(1, $mood)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param $mood
     * @return array
     */
    private function selectUser($mood): array {

        $qb = $this->em->createQueryBuilder();
        $req = $qb->select('m.id')
            ->from(Mood::class, 'm')
            ->where('m.mooduser = ?1')
            ->setParameter(1, $mood)
            ->getQuery();
            $result = $req->getResult();
        if($result) {
            return $result;
        } else {
            return [];
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
