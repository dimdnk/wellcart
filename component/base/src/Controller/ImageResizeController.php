<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Controller;

use TckImageResizer\Controller\IndexController;

class ImageResizeController extends IndexController
{
    /**
     * @return \Zend\Http\Response
     */
    public function resizeAction()
    {
        $source = WELLCART_UPLOAD_PATH
            . $this->params('file')
            . '.' . $this->params('extension');
        $targetExtension = $this->params('extension');
        if (!file_exists($source)) {
            $source = null;
            $targetExtension = '404.' . $targetExtension . '.png';
        }

        $target = WELLCART_MEDIA_PATH
            . $this->params('file')
            . '.$' . $this->params('command')
            . '.' . $targetExtension;

        if ($source) {
            $this->getImageProcessing()->process(
                $source, $target, $this->params('command')
            );

        } else {
            $this->getImageProcessing()->process404(
                $target, $this->params('command')
            );
        }

        $imageInfo = getimagesize($target);
        $mimeType = $imageInfo['mime'];

        /** @var \Zend\Http\Response $response */
        $response = $this->getResponse();
        $response->setContent(file_get_contents($target));
        $response->setStatusCode($source ? 200 : 404);
        $response
            ->getHeaders()
            ->addHeaderLine('Content-Transfer-Encoding', 'binary')
            ->addHeaderLine('Content-Type', $mimeType);

        return $response;
    }
}
