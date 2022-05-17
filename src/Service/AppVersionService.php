<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class AppVersionService
{
    private $appKernel;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }

    public function currentVersion(): string
    {
        return file_get_contents($this->appKernel->getProjectDir().'/VERSION');
    }
}
