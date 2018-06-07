<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var string
     */
    private $targetDir;

    /**
     * FileUploader constructor.
     *
     * @param string $targetDir
     */
    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * @return string
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }

    /**
     * @param UploadedFile $file
     * @param string $subDir
     * @return string
     */
    public function upload(UploadedFile $file, $subDir = '')
    {
        $directory = str_replace('//', '/', $this->getTargetDir() . "/$subDir");
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($directory, $fileName);

        return $fileName;
    }
}
