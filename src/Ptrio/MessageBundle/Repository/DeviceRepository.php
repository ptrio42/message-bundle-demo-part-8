<?php

namespace App\Ptrio\MessageBundle\Repository;
use Doctrine\ORM\{
    EntityManagerInterface, EntityRepository
};
class DeviceRepository extends
    EntityRepository implements
    DeviceRepositoryInterface
{
    public function __construct(EntityManagerInterface $em, string $class)
    {
        parent::__construct($em, $em->getClassMetadata($class));
    }
    
    public function findDevicesByNames(array $deviceNames): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('d')
            ->from($this->getEntityName(), 'd')
        ;
        for ($i = 0; $i < count($deviceNames); $i++) {
            $qb
                ->orWhere($qb->expr()->eq('d.name', ':param_'.$i))
                ->setParameter(':param_'.$i, $deviceNames[$i])
            ;
        }
        return $qb->getQuery()->getResult();
    }
}