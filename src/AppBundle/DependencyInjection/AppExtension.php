<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class AppExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('presenter_first_name', $config['presenter']['first_name']);
        $container->setParameter('presenter_last_name', $config['presenter']['last_name']);
        $container->setParameter('presenter_company', $config['presenter']['company']);
    }
}
