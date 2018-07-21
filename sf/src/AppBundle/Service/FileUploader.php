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
     * @throws \Exception
     */
    public function upload(UploadedFile $file, $subDir = '')
    {
        $directory = str_replace('//', '/', $this->getTargetDir() . "/$subDir");
        $extension = $file->guessExtension();
        $code = md5(uniqid());
        $fileName = $code.'.'.$extension;
        $uploadedFile = $file->move($directory, $fileName);

        if ('zip' == $extension) {
            if (file_exists($uploadedFile->getPathname()) === false) {
                throw new \Exception('Zip file moved error.');
            }

            $zip = new \ZipArchive();
            $x = $zip->open($uploadedFile->getPathname());  // open the zip file to extract
            if ($x === true) {
                $zip->extractTo($directory . DIRECTORY_SEPARATOR . $code); // place in the directory with same name
                $zip->close();

                unlink($uploadedFile->getPathname());
                $fileName = $code;
            }
        }

        return $fileName;
    }
}
