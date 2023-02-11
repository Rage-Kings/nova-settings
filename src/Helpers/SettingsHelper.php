<?php

use RageKings\NovaSettings\SettingsService;

/**
 * @param string $key
 * @param null|mixed $default
 * @return mixed
 */
function settings(string $key, mixed $default = null): mixed
{
    /** @var SettingsService $service */
    $service = app(SettingsService::class);

    return $service->get($key, $default);
}