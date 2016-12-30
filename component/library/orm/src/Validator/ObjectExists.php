<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM\Validator;

use Doctrine\DBAL\Query\QueryBuilder;
use DoctrineModule\Validator\ObjectExists as AbstractObjectExists;
use WellCart\ORM\Entity;

class ObjectExists extends AbstractObjectExists
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

            if ($entityId > 0) {
                $value = $this->cleanSearchValue($value);

                /**
                 * @var $qb QueryBuilder
                 */
                $qb = $this->objectRepository->createQueryBuilder('v');
                $qb->setMaxResults(1)
                    ->andWhere('v.id != ' . $entityId);
                foreach ($value as $_key => $_value) {
                    $qb->andWhere('v.' . $_key . ' = :' . $_key)
                        ->setParameter($_key, $_value);
                }

                $match = $qb->getQuery()->getOneOrNullResult();

                if (is_object($match)) {
                    return true;
                }

                $this->error(self::ERROR_NO_OBJECT_FOUND, $value);
                return false;
            }
        }


        return parent::isValid($value);
    }
}