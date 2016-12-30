<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\Catalog\Entity\Category;
use WellCart\Catalog\Entity\CategoryI18n;
use WellCart\Catalog\Entity\ProductTemplate;
use WellCart\Catalog\Entity\ProductTemplateI18n;
use WellCart\Setup\DataFixture\AbstractFixture;
use WellCart\Setup\DataFixture\PermissionsProviderInterface;

/**
 * @codeCoverageIgnore
 */
class Install
    extends AbstractFixture
    implements PermissionsProviderInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createProductTemplate($manager);
        $this->createRootCategory($manager);
    }

    private function createProductTemplate(ObjectManager $manager)
    {
        $language = $manager->find(
            'WellCart\Base\Entity\Locale\Language',
            1
        );

        $template = new ProductTemplate();
        $template->setIsSystem(true);
        $translation = new ProductTemplateI18n();
        $translation
            ->setLanguage($language)
            ->setName('Default')
            ->setProductTemplate($template);

        $template->addTranslation($translation);

        $manager->persist($template);
        $manager->flush();
    }

    private function createRootCategory(ObjectManager $manager)
    {
        $language = $manager->find(
            'WellCart\Base\Entity\Locale\Language',
            1
        );

        $category = new Category();
        $category->setIsVisible(1)
            ->setUrlKey('root');

        $translation = new CategoryI18n();
        $translation
            ->setLanguage($language)
            ->setName('Root Category')
            ->setDescription('Root Category')
            ->setCategory($category);

        $category->addTranslation($translation);

        $manager->persist($category);
        $manager->flush();
    }

    public function getPermissionsDefinition(): array
    {
        return [
            ['name' => 'catalog/view',],
            ['name' => 'catalog/products/group-action-handler',],
            ['name' => 'catalog/products/list',],
            ['name' => 'catalog/products/template',],
            ['name' => 'catalog/products/view',],
            ['name' => 'catalog/products/create',],
            ['name' => 'catalog/products/update',],
            ['name' => 'catalog/products/delete',],
            ['name' => 'catalog/products/variants',],

            ['name' => 'catalog/categories/group-action-handler',],
            ['name' => 'catalog/categories/list',],
            ['name' => 'catalog/categories/view',],
            ['name' => 'catalog/categories/create',],
            ['name' => 'catalog/categories/update',],
            ['name' => 'catalog/categories/delete',],

            ['name' => 'catalog/brands/group-action-handler',],
            ['name' => 'catalog/brands/list',],
            ['name' => 'catalog/brands/view',],
            ['name' => 'catalog/brands/create',],
            ['name' => 'catalog/brands/update',],
            ['name' => 'catalog/brands/delete',],

            ['name' => 'catalog/features/list',],
            ['name' => 'catalog/features/view',],
            ['name' => 'catalog/features/create',],
            ['name' => 'catalog/features/update',],
            ['name' => 'catalog/features/delete',],

            ['name' => 'catalog/attributes/group-action-handler',],
            ['name' => 'catalog/attributes/list',],
            ['name' => 'catalog/attributes/view',],
            ['name' => 'catalog/attributes/create',],
            ['name' => 'catalog/attributes/update',],
            ['name' => 'catalog/attributes/delete',],

            ['name' => 'catalog/product-templates/group-action-handler',],
            ['name' => 'catalog/product-templates/list',],
            ['name' => 'catalog/product-templates/view',],
            ['name' => 'catalog/product-templates/create',],
            ['name' => 'catalog/product-templates/update',],
            ['name' => 'catalog/product-templates/delete',],
        ];
    }
}
