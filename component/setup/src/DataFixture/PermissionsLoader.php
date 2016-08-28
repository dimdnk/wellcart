<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\DataFixture;

use Doctrine\ORM\EntityManager;
use WellCart\User\Entity\Acl\Permission;
use WellCart\Utility\Arr;

class PermissionsLoader
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Loader constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function load(array $fixtures)
    {
        $manager = $this->em;
        foreach ($fixtures as $fixture) {
            if (!$fixture instanceof PermissionsProviderInterface) {
                continue;
            }

            $permissions = $fixture->getPermissionsDefinition();
            foreach ($permissions as $permission) {
                $name = Arr::get($permission, 'name');
                $description = Arr::get($permission, 'description');
                $object = new Permission($name);
                $object->setDescription($description)
                    ->setIsSystem(true);
                $manager->persist($object);
                $manager->flush();
            }
        }

    }
}