<?php

namespace ContributorsBundle\Cache;

use Doctrine\Common\Cache\CacheProvider;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

class ContributorsCacheCleaner implements CacheClearerInterface
{
    /**
     * @var CacheProvider
     */
    private $cacheProvider;

    public function __construct(CacheProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
    }

    /**
     * @inheritdoc
     */
    public function clear($cacheDir)
    {
        $this->cacheProvider->flushAll();
    }
}
