<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\InputFilter;

use WellCart\Utility\Config;
use Zend\ServiceManager\ServiceLocatorInterface;

class InputFilterAbstractServiceFactory extends
    \Zend\InputFilter\InputFilterAbstractServiceFactory
{

    use DomainInputFilterSpecConfigTrait;

    /**
     * @inheritdoc
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $inputFilters,
        $cName, $rName
    ) {
        $rName = $this->realEntityName($rName);
        $spec = $this->getDomainEntityInputFilterSpecification($rName);
        if (!empty($spec)) {
            return true;
        }

        return parent::canCreateServiceWithName($inputFilters, $cName, $rName);
    }

    /**
     * Helper for simply maps interface to class name
     *
     * @param $rName
     *
     * @return string
     */
    protected function realEntityName($rName)
    {
        if (strpos($rName, 'Interface') !== false
            && $entityName = Config::get(
                'doctrine.entity_resolver.orm_default.resolvers.' . $rName
            )
        ) {
            $rName = $entityName;
        }

        return $rName;
    }

    /**
     * @inheritdoc
     */
    public function createServiceWithName(ServiceLocatorInterface $inputFilters,
        $cName, $rName
    ) {
        $rName = $this->realEntityName($rName);
        $spec = $this->getDomainEntityInputFilterSpecification($rName);
        if (empty($spec)) {
            return parent::createServiceWithName($inputFilters, $cName, $rName);
        }
        $services = $inputFilters->getServiceLocator();
        $factory = $this->getInputFilterFactory($services);

        return $factory->createInputFilter($spec);
    }
}