<?php
namespace CleanPhp\Invoicer\Persistence\Doctrine\Repository;

use CleanPhp\Invoicer\Domain\Entity\AbstractEntity;
use CleanPhp\Invoicer\Domain\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManager;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractDoctrineRepository
 *
 * @author alexandr
 */
abstract class AbstractDoctrineRepository implements RepositoryInterface
{
    protected $entityManager;
    protected $entityClass;
    
    public function __construct(EntityManager $em)
    {
        if (empty($this->entityClass)) {
            throw new \RuntimeException(
                    get_class($this) . '::$entityClass is not defined'
                    );
        }
        $this->entityManager = $em;
    }
    
    public function getById($id)
    {
        return $this->entityManager->find($this->entityClass, $id);
    }
    
    public function getAll()
    {
        return $this->entityManager->getRepository($this->entityClass)
                ->findAll();
    }
    
    public function getBy(
            $conditions = [],
            $order = [],
            $limit = null,
            $offset = null
            )
    {
        $repository = $this->entityManager->getRepository($this->entityClass);
        $result = $repository->findBy($conditions, $order, $limit, $offset);
        return $result;
    }
    
    public function persist(AbstractEntity $entity)
    {
        $this->entityManager->persist($entity);
        return $this;
    }
    
    public function begin()
    {
        $this->entityManager->beginTransaction();
        return $this;
    }
    
    public function commit()
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
        return $this;
    }
}
