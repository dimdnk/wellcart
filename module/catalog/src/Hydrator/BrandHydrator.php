<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Hydrator;

use WellCart\Catalog\Spec\BrandEntity;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\Utility\Arr;

class BrandHydrator extends ObjectHydrator
{

    /**
     * @inheritdoc
     */
    public function hydrate(array $data, $object)
    {
        /**
         * @var $object BrandEntity
         */
        $removeImage = (bool)Arr::get($data, 'remove_image', false);
        if ($removeImage) {
            if ($object->hasImage()) {
                $object->setImageFullPath(null);
            }
        } else {
            $filename = Arr::get($data, 'image.tmp_name');
            if (!empty($filename)) {
                $filename = str_replace('\\', '/', trim($filename));
                $filename = str_replace(
                    WELLCART_UPLOAD_PATH,
                    '',
                    $filename
                );
                $object->setImageFullPath($filename);
            }
        }

        return parent::hydrate($data, $object);
    }
}
