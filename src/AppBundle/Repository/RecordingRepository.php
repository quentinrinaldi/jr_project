<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RecordingRepository extends EntityRepository
{
  public function getNextRecordings($tvShowID)
{
  $qb = $this
    ->createQueryBuilder('rec');
  $qb->join('rec.tvShow', 'tv', 'WITH', 'tv.id = :tvShowID AND rec.date >= CURRENT_DATE()')->setParameter('tvShowID', $tvShowID);

  return $qb
    ->getQuery()
    ->getResult()
  ;
}

  public function getRecordings($tvShowID)
{
  $qb = $this
    ->createQueryBuilder('rec');
  $qb->where('rec.tvShow = :tvShowID')
  ->setParameter('tvShowID', $tvShowID);

  return $qb
    ->getQuery()
    ->getResult()
  ;
}
}
