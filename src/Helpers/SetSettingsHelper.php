<?php

use RageKings\NovaSettings\SettingsService;

function set_settings(string $key, $value): void
{
    app(SettingsService::class)->set($key, $value);
}