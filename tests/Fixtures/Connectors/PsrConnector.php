<?php

declare(strict_types=1);

namespace Saloon\RateLimitPlugin\Tests\Fixtures\Connectors;

use Saloon\Http\Connector;
use Saloon\RateLimitPlugin\Limit;
use Psr\SimpleCache\CacheInterface;
use Saloon\RateLimitPlugin\Stores\PsrStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Tests\Fixtures\Helpers\ArrayPsrCache;

final class PsrConnector extends Connector
{
    use HasRateLimits;

    public readonly CacheInterface $cache;

    public function __construct()
    {
        $this->cache = new ArrayPsrCache;
    }

    public function resolveBaseUrl(): string
    {
        return 'https://tests.saloon.dev/api';
    }

    /**
     * Resolve the limits
     */
    protected function resolveLimits(): array
    {
        return [
            Limit::allow(10)->everyMinute(),
            Limit::allow(20)->everyHour(),
        ];
    }

    /**
     * Resolve the rate limiter store to use
     */
    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new PsrStore($this->cache);
    }
}
