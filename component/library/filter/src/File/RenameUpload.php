<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Filter\File;

use WellCart\Base\Exception;
use WellCart\Utility\Str;

class RenameUpload extends \Zend\Filter\File\RenameUpload
{

    /**
     * If this variable is set to TRUE, our library will be able to automatically create
     * non-existed directories.
     *
     * @var bool
     */
    protected $allowCreateFolders = false;

    /**
     * It helps to avoid problems after migrating from case-insensitive file system to case-insensitive
     * (e.g. NTFS->ext or ext->NTFS)
     *
     * @var bool
     */
    protected $caseInsensitiveFilename = false;

    /**
     * Transliterate target filename
     *
     * @var bool
     */
    protected $transliterateFilename = false;

    /**
     * If this variable is set to TRUE, files despersion will be supported.
     *
     * @var bool
     */
    protected $enableFileDispersion = false;

    /**
     * Despersion path
     *
     * @var string
     */
    protected $despersionPath = null;

    /**
     * Target directory
     *
     * @var string
     */
    protected $targetDirectory = null;

    /**
     * Set enable files dispersion
     *
     * @param boolean $enableFileDispersion
     *
     * @return RenameUpload
     */
    public function setEnableFileDispersion($enableFileDispersion)
    {
        $this->enableFileDispersion = (bool)$enableFileDispersion;
        if ($enableFileDispersion) {
            $this->setAllowCreateFolders(true);
            $this->setTransliterateFilename(true);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function getFinalTarget($uploadData)
    {
        $isUploaded = !empty($uploadData['tmp_name']);
        if (!$isUploaded) {
            return $this->getTarget();
        }
        $this->createFolders();
        $finalTarget = parent::getFinalTarget($uploadData);
        if ($isUploaded) {
            $finalTarget = $this->fixCaseInsensitiveFilename($finalTarget);
            $finalTarget = $this->transliterateFilename($finalTarget);
            $finalTarget = $this->fileDispersion($finalTarget);
        }

        return $finalTarget;
    }

    /**
     * Create destination folder on the fly
     *
     * @return void
     */
    protected function createFolders()
    {
        $dir = null;
        $target = $this->targetDirectory;
        if (!empty($target)) {
            $target = rtrim($target, '/') . DS;
            $this->setTarget($target);
            $dir = $target;
        }

        if ($dir !== null) {
            $isDir = is_dir($dir);
            if (!$isDir) {
                if ($this->isAllowCreateFolders()) {
                    mkdir($dir, 0777, true);
                } else {
                    throw new Exception\NoSuchDirectoryException(
                        sprintf('Directory %s does not exists.', $dir)
                    );
                }
            }
        }
    }

    /**
     * Retrieve target directory path
     *
     * @return string
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    /**
     * Set target directory path
     *
     * @param string $targetDirectory
     *
     * @return RenameUpload
     */
    public function setTargetDirectory($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;

        return $this;
    }

    /**
     * Is allow create folders
     *
     * @return boolean
     */
    public function isAllowCreateFolders()
    {
        return $this->allowCreateFolders;
    }

    /**
     * Allow create folders
     *
     * @param boolean $allowCreateFolders
     *
     * @return RenameUpload
     */
    public function setAllowCreateFolders($allowCreateFolders)
    {
        $this->allowCreateFolders = (bool)$allowCreateFolders;

        return $this;
    }

    /**
     * Fix case-insensitive filename
     *
     * @param $finalTarget
     *
     * @return string
     */
    protected function fixCaseInsensitiveFilename($finalTarget)
    {
        $targetFile = basename($finalTarget);
        if ($this->isCaseInsensitiveFilename()) {
            $finalTarget = str_replace(
                $targetFile,
                Str::lower($targetFile),
                $finalTarget
            );
        }

        return $finalTarget;
    }

    /**
     * @return boolean
     */
    public function isCaseInsensitiveFilename()
    {
        return $this->caseInsensitiveFilename;
    }

    /**
     * Set case insensitive filenames
     *
     * @param boolean $caseInsensitiveFilename
     *
     * @return RenameUpload
     */
    public function setCaseInsensitiveFilename($caseInsensitiveFilename)
    {
        $this->caseInsensitiveFilename = (bool)$caseInsensitiveFilename;

        return $this;
    }

    /**
     * Transliterate filename
     *
     * @param $finalTarget
     *
     * @return string
     */
    protected function transliterateFilename($finalTarget)
    {
        $targetFile = basename($finalTarget);
        if ($this->isTransliterateFilename()) {
            $filename = pathinfo($targetFile)['filename'];
            $finalTarget = str_replace(
                $filename,
                Str::slug($filename),
                $finalTarget
            );
        }

        return $finalTarget;
    }

    /**
     * @return boolean
     */
    public function isTransliterateFilename()
    {
        return $this->transliterateFilename;
    }

    /**
     * @param boolean $transliterateFilename
     *
     * @return RenameUpload
     */
    public function setTransliterateFilename($transliterateFilename)
    {
        $this->transliterateFilename = (bool)$transliterateFilename;
        if ($transliterateFilename) {
            $this->setCaseInsensitiveFilename(true);
        }

        return $this;
    }

    /**
     * Process file dispersion
     *
     * @param $finalTarget
     *
     * @return mixed
     */
    protected function fileDispersion($finalTarget)
    {
        if ($this->isFileDispersionEnabled()) {
            $file = pathinfo($finalTarget, PATHINFO_BASENAME);
            $dispersionPath = $this->getDispersionPath($file);
            $directory = pathinfo($finalTarget, PATHINFO_DIRNAME) .
                $dispersionPath;
            $originalTargetDir = $this->targetDirectory;

            $this->targetDirectory = $directory;
            $this->createFolders();
            $this->targetDirectory = $originalTargetDir;
            $finalTarget = $directory . $file;
        }

        return $finalTarget;
    }

    /**
     * Is  file dispersion enabled
     *
     * @return boolean
     */
    public function isFileDispersionEnabled()
    {
        return $this->enableFileDispersion;
    }

    /**
     * Get dispersion path
     *
     * @param $fileName
     *
     * @return string
     */
    private function getDispersionPath($fileName)
    {
        $char = 0;
        $dispertionPath = DS;
        while (($char < 2) && ($char < strlen($fileName))) {
            if (empty($dispertionPath)) {
                $dispertionPath = DS
                    . ('.' == $fileName[$char] ? '_' : $fileName[$char]);
            } else {
                $dispertionPath = $this->addDirectorySeparator($dispertionPath)
                    . ('.' == $fileName[$char] ? '_' : $fileName[$char]);
            }
            $char++;
        }

        return $dispertionPath . DS;
    }

    /**
     * Add dir separator
     *
     * @param $dir
     *
     * @return string
     */
    private function addDirectorySeparator($dir)
    {
        if (substr($dir, -1) != DS) {
            $dir .= DS;
        }

        return $dir;
    }
}