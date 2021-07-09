<?php


namespace Chaplin\Core\Infrastructure;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class AbstractDoctrineRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    abstract public function className(): string;

    abstract public function dqlAlias(): string;

    protected function getRepository(): ObjectRepository
    {
        return $this->entityManager->getRepository($this->className());
    }
}