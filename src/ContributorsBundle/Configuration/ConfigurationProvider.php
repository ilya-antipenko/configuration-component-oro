<?php

namespace ContributorsBundle\Configuration;

use ContributorsBundle\Configuration\ContributorsConfiguration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class ConfigurationProvider
{
    /**
     * @var array
     */
    private $bundles;

    public function __construct(array $bundles)
    {
        $this->bundles = $bundles;
    }

    /**
     * @param string $filePath Example: Resources/config/contributors.yml
     */
    public function load(string $filePath)
    {
        $configurationFiles = $this->findFiles($filePath);

        $configs = [];
        foreach ($configurationFiles as $file) {
            $configs[] = Yaml::parseFile($file);
        }

        $processor = new Processor();
        $processedConfig = $processor->processConfiguration(new ContributorsConfiguration(), $configs);

        return $processedConfig;
    }

    private function findFiles(string $filePath)
    {
        $paths = [];
        foreach ($this->bundles as $bundleName => $bundleClass) {
            $reflectionClass = new \ReflectionClass($bundleClass);
            $bundleDir = \dirname($reflectionClass->getFileName());
            $paths[] = $bundleDir;

        }
        $fileLocator = new FileLocator($paths);
        try {
            return $fileLocator->locate($filePath, null, false);
        } catch (FileLocatorFileNotFoundException $e) {
            return [];
        }
    }
}
