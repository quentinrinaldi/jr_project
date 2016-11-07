<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RegistrationRequestRepository extends EntityRepository
{
  public function getRegistrationRequest($tvShowID)
{
  $qb = $this
    ->createQueryBuilder('reg');
  $qb->join('reg.tvShow', 'tv', 'WITH', 'tv.id = :tvShowID')->setParameter('tvShowID', $tvShowID);

  return $qb
    ->getQuery()
    ->getResult()
  ;
}
}