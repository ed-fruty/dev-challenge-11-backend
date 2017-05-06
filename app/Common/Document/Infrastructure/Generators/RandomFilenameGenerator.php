<?php

namespace App\Common\Document\Infrastructure\Generators;


use App\Common\Document\Contracts\FilenameGeneratorInterface;
use Illuminate\Http\UploadedFile;

class RandomFilenameGenerator implements FilenameGeneratorInterface
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function fromUploadedFile(UploadedFile $file): string
    {
        return uniqid() . microtime(true) . mt_rand(100000, 999999) . '.' . $file->extension();
    }
}