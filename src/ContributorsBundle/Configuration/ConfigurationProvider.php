<?php

namespace ContributorsBundle\Configuration;

use ContributorsBundle\Configuration\ContributorsConfiguration;
use Doctrine\Common\Cache\CacheProvider;
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

    /**
     * @var CacheProvider
     */
    private $cacheProvider;

    public function __construct(array $bundles, CacheProvider $cacheProvider)
    {
        $this->bundles = $bundles;
        $this->cacheProvider = $cacheProvider;
    }

    /**
     * @param string $filePath Example: Resources/config/contributors.yml
     * @return array
     */
    public function load(string $filePath): array
    {
        $cachedConfig = $this->cacheProvider->fetch($filePath);

        if ($cachedConfig) {
            return $cachedConfig;
        }

        $resolvedConfig = $this->resolveConfiguration($filePath);
        $this->cacheProvider->save($filePath, $resolvedConfig);

        return $resolvedConfig;
    }

    private function resolveConfiguration($filePath): array
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

    private function findFiles(string $filePath): array
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
