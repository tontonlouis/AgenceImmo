<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository {
	public function __construct(RegistryInterface $registry) {
		parent::__construct($registry, Property::class);
	}

	/**
	 * @return Query
	 */
	public function findAllVisibleQuery(PropertySearch $search): Query{
		$query = $this->findVisibleQuery();

		if ($search->getLat() && $search->getLng()) {
			$query = $query
				->select('p')
				->andWhere('(6343 * 2 * ASIN(SQRT(POWER(SIN((p . lat - :lat) * pi() / 180 / 2), 2) + COS(p . lat * pi() / 180) * COS(:lat * pi () / 180) * POWER(SIN((p . lng - :lng) * pi() / 180 / 2), 2)))) <= :distance')

				->setParameter('lng', $search->getLng())
				->setParameter('lat', $search->getLat())
				->setParameter('distance', $search->getDistance());

		}

		if ($search->getMaxPrice()) {
			$query = $query
				->andWhere('p.price <= :maxPrice')
				->setParameter('maxPrice', $search->getMaxPrice());
		}

		if ($search->getMinSurface()) {
			$query = $query
				->andWhere('p.surface >= :minSurface')
				->setParameter('minSurface', $search->getMinSurface());
		}

		if ($search->getOptions()->count() > 0) {
			foreach ($search->getOptions() as $k => $option) {
				dump($k);
				$query = $query
					->andWhere(":option$k MEMBER OF p.options")
					->setParameter("option$k", $option);
			}
		}

		return $query->getQuery();

	}

	/**
	 * @return Property[]
	 */
	public function findLatest(): array
	{
		return $this->findVisibleQuery()
			->setMaxResults(4)
			->getQuery()
			->getResult();
	}

	private function findVisibleQuery(): QueryBuilder {
		return $this->createQueryBuilder('p')
			->where('p.sold = false');
	}

}
