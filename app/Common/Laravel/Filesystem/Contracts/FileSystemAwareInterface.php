<?php

namespace App\Common\Laravel\Filesystem\Contracts;

use Illuminate\Contracts\Filesystem\Factory;

interface FileSystemFactoryAwareInterface
{
    /**
     * @param Factory $filesystemFactory
     * @return mixed
     */
    public function setFilesystemFactory(Factory $filesystemFactory);
}
