<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Command\Handler;

use WellCart\Catalog\Command\PersistProduct;
use WellCart\Catalog\Entity\FeatureCombination;
use WellCart\Catalog\Spec\FeatureCombinationEntity;
use WellCart\Catalog\Spec\FeatureValueEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\CommandBus\Command\PersistEntity;
use WellCart\CommandBus\CommandHandler\PersistEntityHandler;
use WellCart\ORM\Entity;

class PersistProductHandler extends PersistEntityHandler
{
    /**
     * @param PersistProduct $command
     *
     * @return Entity
     */
    public function handle(PersistEntity $command): Entity
    {
        $om = $this->getObjectManager();
        /**
         * @var ProductEntity $product
         */
        $product = $command->getEntity();
        if (!$product->getProductTemplate()) {
            $template = $om->getRepository(ProductTemplateEntity::class)
                ->findPrimary();
            $product->setProductTemplate($template);

        }
        $form = $command->getForm();
        $combiIds = (array)$form->getInputFilter()->getRawValues(
        )['product']['features'];
        $product->getFeatures()->clear();

        foreach ($combiIds as $combiId) {
            $featureCombination = new FeatureCombination();
            /**
             * @var FeatureCombinationEntity $featureCombination
             */
            $featureValue = $om->find(FeatureValueEntity::class, $combiId);
            $featureCombination->setFeatureValue($featureValue)
                ->setFeature($featureValue->getFeature())
                ->setProduct($product);
            $product->addFeature($featureCombination);
        }

        return parent::handle($command);
    }

}
