<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TVShowRepository extends EntityRepository
{
  public function getNextRecordings()
{
  $qb = $this
    ->createQueryBuilder('a');
  $qb->join('a.recordings', 'app', 'WITH', 'app.date < CURRENT_DATE()');

  return $qb
    ->getQuery()
    ->getResult()
  ;
}
}
