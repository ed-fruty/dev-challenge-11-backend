<?php
namespace App\Common\Document\Concern\Commands;

use Illuminate\Http\UploadedFile;

final class CreateDocumentCommand
{
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * CreateDocumentCommand constructor.
     * @param UploadedFile $file
     */
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}