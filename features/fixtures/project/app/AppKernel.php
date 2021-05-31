<?php

declare(strict_types=1);

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * @return array<Bundle>
     */
    public function registerBundles(): array
    {
        return [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new FSi\FixturesBundle\FSiFixturesBundle(),
            new FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(sprintf('%s/config/config.yml', __DIR__));
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir() . '/FSiFormExtensionsBundle/cache';
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir() . '/FSiFormExtensionsBundle/logs';
    }
}
