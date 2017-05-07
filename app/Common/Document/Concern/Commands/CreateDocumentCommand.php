<?php
namespace App\Common\Document\Concern\Commands;

use Illuminate\Http\UploadedFile;

final class CreateDocumentCommand
{
    /**
     * @var UploadedFile
     */
    private $file;
    private $savePath;
    private $disk;

    /**
     * CreateDocumentCommand constructor.
     * @param UploadedFile $file
     * @param string $savePath
     * @param string $disk
     */
    public function __construct(UploadedFile $file, string $savePath, string $disk)
    {
        $this->file = $file;
        $this->savePath = $savePath;
        $this->disk = $disk;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getSavePath()
    {
        return $this->savePath;
    }

    /**
     * @return mixed
     */
    public function getDisk()
    {
        return $this->disk;
    }
}