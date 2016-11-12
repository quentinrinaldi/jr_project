<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RegistrationRequestRepository extends EntityRepository
{
  public function getRegistrationRequests($tvShowID)
{
  $qb = $this
    ->createQueryBuilder('reg');
  $qb->leftjoin('reg.recording', 'rec', 'WITH', 'rec.id = reg.id')->leftjoin('rec.tvShow', 'tv', 'WITH', 'tv.id = :tvShowID')->setParameter('tvShowID', $tvShowID);

  return $qb
    ->getQuery()
    ->getResult()
  ;
}
}