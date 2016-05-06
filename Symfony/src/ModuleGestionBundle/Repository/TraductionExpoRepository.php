<?php

namespace ModuleGestionBundle\Repository;

use Doctrine\ORM\QueryBuilder;
/**
 * TraductionExpoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TraductionExpoRepository extends \Doctrine\ORM\EntityRepository
{

	public function getTraductionAll()
	{
		$query = $this->createQueryBuilder('t');

		$query->join('t.langue', 'l')
			  ->addSelect('l');

		return $query
					->getQuery()
					->getResult();
	}
}
