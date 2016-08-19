<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Controller;

use HtImgModule\Exception;
use HtImgModule\Service\ImageServiceInterface;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use WellCart\View\Model\ImageModel;

class ImageServiceController extends AbstractActionController
{

    /**
     * @var ImageServiceInterface
     */
    protected $imageService;

    /**
     * Constructor
     *
     * @param ImageServiceInterface $imageService
     */
    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @return ImageModel
     */
    public function imageAction()
    {
        $params = $this->params();
        $module = $params->fromRoute('module', '');
        $entity = $params->fromRoute('entity', '');

        $filter = $params->fromRoute('filter_name', '');
        $width = abs((int)$params->fromRoute('width', 0));
        $height = abs((int)$params->fromRoute('height', 0));

        if (!$this->accepted($filter, 'width', $width)
            || !$this->accepted(
                $filter,
                'height',
                $height
            )
        ) {
            return $this->notFoundAction();
        }
        $imagePath = $params->fromRoute('image', '');

        $relativePath = $module . DS
            . $entity . DS
            . 'original_image' . DS
            . $imagePath;


        try {
            $imageData = $this->imageService->getImage($relativePath, $filter);
        } catch (Exception\ImageNotFoundException $e) {
            return $this->notFoundAction();
        } catch (Exception\FilterNotFoundException $e) {
            return $this->notFoundAction();
        }

        if (!$imageData) {
            return $this->notFoundAction();
        }

        return new ImageModel(
            $imageData['image'],
            $imageData['format'],
            $imageData['imageOutputOptions']
        );
    }

    protected function accepted(string $filter, string $type, int $value): bool
    {
        $theme = $this->params()->fromRoute('theme', '');
        $themeConfig = (array)$this->getServiceLocator()->get('ZeThemeManager')
            ->getThemeConfig($theme);
        $var = (int)Arr::get(
            $themeConfig,
            'images.filters.' . $filter . '.options.' . $type
        );

        if ($var > 0 && $var === $value) {
            return true;
        }
        $var = (int)Config::get(
            'design.images.filters.' . $filter . '.options.' . $type
        );

        if ($var > 0) {
            return ($var === $value);
        }
        $var = (int)Config::get(
            'htimg.filters.' . $filter . '.options.' . $type
        );
        if ($var > 0) {
            return ($var === $value);
        }
        return false;
    }
}
