<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new FSi\FixturesBundle\FSiFixturesBundle(),
            new FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle()
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(sprintf('%s/config/config.yml', __DIR__));
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/FSiFormExtensionsBundle/cache';
    }

    public function getLogDir()
    {
        return sys_get_temp_dir() . '/FSiFormExtensionsBundle/logs';
    }
}