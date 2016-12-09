<?php
// src/OC/PlatformBundle/Entity/AdvertRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TVShowRepository extends EntityRepository {


	public function getCurrentTvShows() {
		$qb = $this->createQueryBuilder('a');
		$qb->join('a.recordings', 'rec', 'WITH', 'rec.date > CURRENT_DATE()');


		return $qb
		->getQuery()
		->getResult()
		;
	}

	public function getPastTvShows() {
		$actualTvShows = $this->createQueryBuilder('a')->join('a.recordings', 'rec', 'WITH', 'rec.date > CURRENT_DATE()');

		$pastTvShows = $this->createQueryBuilder('a');
		$pastTvShows->where($pastTvShows->expr()->notIn('a.id', ':qb'))->setParameter('qb', $actualTvShows->getQuery()->getArrayResult());

		return $pastTvShows
		->getQuery()
		->getResult()
		;
	}


}
