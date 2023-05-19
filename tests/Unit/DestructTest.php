<?php

declare(strict_types=1);

use Saloon\RateLimitPlugin\Tests\Fixtures\Connectors\RedisDestructConnector;

test('the connector can still be destructed properly', function () {
    $destructed = false;
    $connector = new RedisDestructConnector($destructed);

    expect($destructed)->toBeFalse();

    unset($connector);

    expect($destructed)->toBeTrue();
});