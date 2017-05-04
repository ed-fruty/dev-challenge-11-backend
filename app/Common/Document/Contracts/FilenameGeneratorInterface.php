<?php
namespace App\Common\Document\Contracts;

use Illuminate\Http\UploadedFile;

interface FilenameGeneratorInterface
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function fromUploadedFile(UploadedFile $file) : string;
}