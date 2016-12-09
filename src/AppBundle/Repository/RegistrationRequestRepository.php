<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RegistrationRequestRepository extends EntityRepository
{
  public function getRegistrationRequestsOfTvShow($tvShowID)
{
  $qb = $this
    ->createQueryBuilder('reg');
  $qb->leftjoin('reg.recording', 'rec', 'WITH', 'rec.date >= CURRENT_DATE()')->leftjoin('rec.tvShow', 'tv')->where('tv.id = :tvShowID')->setParameter('tvShowID', $tvShowID);

  return $qb
    ->getQuery()
    ->getResult()
  ;
}

public function getRegistrationRequestWithRecordingAndLocation ($id) {
	$qb = $this
    ->createQueryBuilder('reg')->where('reg.id = :id')->setParameter('id', $id);

    $qb->leftjoin('reg.recording', 'rec')->leftjoin('rec.tvShow', 'tv')->leftjoin('tv.location', 'loc');

    return $qb
    ->getQuery()
    ->getOneOrNullResult();

}
}