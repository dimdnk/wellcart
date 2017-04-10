<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\ORM\Validator;

use Doctrine\DBAL\Query\QueryBuilder;
use DoctrineModule\Validator\NoObjectExists as AbstractNoObjectExists;
use WellCart\ORM\Entity;

class NoObjectExists extends AbstractNoObjectExists
{

  /**
   * @var Entity
   */
  protected $domainObject;

  /**
   * Constructor
   *
   * @param array $options required keys are `object_repository`, which must be an instance of
   *                       Doctrine\Common\Persistence\ObjectRepository, and `fields`, with either
   *                       a string or an array of strings representing the fields to be matched by the validator.
   *
   * @throws \Zend\Validator\Exception\InvalidArgumentException
   */
  public function __construct(array $options)
  {

    if (isset($options['entity_class'])
      && is_string($options['entity_class'])
    ) {
      $entityClass = $options['entity_class'];
      $options['object_repository'] = application()
        ->getServiceManager()
        ->get('Doctrine\ORM\EntityManager')
        ->getRepository($entityClass);
      unset($options['entity_class']);
    }

    if (isset($options['domain_object'])
      && $options['domain_object'] instanceof Entity
    ) {
      $this->domainObject = $options['domain_object'];
      unset($options['domain_object']);
    }

    parent::__construct($options);
  }

  /**
   * {@inheritDoc}
   */
  public function isValid($value)
  {
    if ($value === null) {
      return true;
    }
    if ($this->domainObject) {
      $entityId = $this->domainObject->getId();
      if ($entityId) {
        $value = $this->cleanSearchValue($value);
        /**
         * @var $qb QueryBuilder
         */
        $qb = $this->objectRepository->createQueryBuilder('v');
        $qb->setMaxResults(1)
          ->andWhere('v.id != :entity_id')
          ->setParameter('entity_id', $entityId);
        foreach ($value as $_key => $_value) {
          $qb->andWhere('v.' . $_key . ' = :' . $_key)
            ->setParameter($_key, $_value);
        }

        $match = $qb->getQuery()->getOneOrNullResult();
        if (is_object($match)) {
          $this->error(self::ERROR_OBJECT_FOUND, $value);

          return false;
        }
        return true;
      }
    }

    return parent::isValid($value);
  }
}