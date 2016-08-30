<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Hydrator;

use WellCart\Catalog\Spec\ProductImageEntity;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\Utility\Arr;

class ProductHydrator extends ObjectHydrator
{
    /**
     * @inheritDoc
     */
    public function extract($object)
    {
        return parent::extract($object);
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array  $data
     * @param  object $object
     *
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if ($object instanceof ProductImageEntity
            && $uploadedImage = Arr::get($data, 'image.tmp_name')
        ) {
            $uploadedImage = str_replace(
                '\\',
                '/',
                trim($uploadedImage)
            );
            list($width, $height) = getimagesize($uploadedImage);
            $object->setOriginalFilename(Arr::get($data, 'image.name'))
                ->setImageX($width)
                ->setImageY($height)
                ->setFilename(
                    pathinfo($uploadedImage, PATHINFO_BASENAME)
                )
                ->setFullPath(
                    str_replace(
                        WELLCART_UPLOAD_PATH,
                        '',
                        $uploadedImage
                    )
                );
        }
        return parent::hydrate($data, $object);
    }
}
