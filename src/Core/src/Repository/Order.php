<?php
declare(strict_types=1);

namespace Core\Repository;


use Core\Entity\AbstractRootEntity;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Types\Types as Type;
use Doctrine\ORM\ORMException;

class Order extends AbstractRepository
{
    public function save(\Core\Entity\Order $order): ?\Core\Entity\DTO\Order
    {
        $this->em->beginTransaction();
        try {
            $this->em->persist($order);
            $this->em->flush();
            $this->em->commit();

            return new \Core\Entity\DTO\Order($order->getId());
        } catch (ORMException $e) {
            $this->em->rollback();
            return null;
        }
    }

    public function getById(int $id): ?AbstractRootEntity
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('o.id')
            ->from($this->getTableName(), 'o')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id, Type::INTEGER);

        $stmt = $qb->execute();
        $stmt->setFetchMode(FetchMode::CUSTOM_OBJECT, $this->getObjectPrototype());

        return $stmt->fetch() ?: null;
    }

    protected function getObjectPrototype(): string
    {
        return \Core\Entity\Order::class;
    }

    protected function getTableName(): string
    {
        return '_order';
    }
}