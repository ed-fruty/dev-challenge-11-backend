<?php

namespace App\Common\Laravel\Filesystem\Traits;

use Illuminate\Contracts\Filesystem\Factory;

trait FilesystemFactoryAware
{
    /**
     * @var Factory
     */
    protected $filesystemFactory;

    /**
     * @param Factory $filesystemFactory
     */
    public function setFilesystemFactory(Factory $filesystemFactory)
    {
        $this->filesystemFactory = $filesystemFactory;
    }
}
