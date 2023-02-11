<?php

namespace RageKings\NovaSettings\Tests\Unit\Helpers;

use RageKings\NovaSettings\Models\Option;
use RageKings\NovaSettings\Tests\IntegrationTest;

class SetSettingsHelperTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_set_settings_helper()
    {
        $setting = Option::factory()->create();
        $value = 'test value';
        set_settings($setting->key, $value);
        $setting->refresh();
        $this->assertEquals($setting->value, $value);
    }
}