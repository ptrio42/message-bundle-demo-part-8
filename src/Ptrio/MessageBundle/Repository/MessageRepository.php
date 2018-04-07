<?php

namespace App\Ptrio\MessageBundle\Repository;

use App\Ptrio\MessageBundle\Model\DeviceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository implements MessageRepositoryInterface
{
    public function __construct(EntityManagerInterface $em, string $class)
    {
        parent::__construct($em, $em->getClassMetadata($class));
    }

    public function findMessagesByDevice(DeviceInterface $device, string $sort = 'DESC', int $offset, int $limit): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('m')
            ->from($this->getEntityName(), 'm')
            ->andWhere($qb->expr()->eq('m.device', $device->getId()))
            ->orderBy('m.id', $sort)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
        ;
        return $qb->getQuery()->getResult();
    }
}