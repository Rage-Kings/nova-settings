<?php

namespace RageKings\NovaSettings\Tests\Feature;

use RageKings\NovaSettings\Models\Option;
use RageKings\NovaSettings\Tests\IntegrationTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SettingsToolServiceProviderTest extends IntegrationTest
{
    use WithoutMiddleware, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Option::factory()->count(20)->create();
    }

    public function test_can_read_settings()
    {
        $data = [
            'sections' => [
                '_default' => [
                    'panels' => [
                        'Settings' => []
                    ]
                ]
            ]
        ];

        $response = $this->json('GET','nova-vendor/settings');

        $settings = json_decode($response->getContent(), true);

        $response->assertSuccessful();
        $response->assertJsonMissing($data);
        $this->assertTrue(count($settings['sections']['_default']['panels']['Settings']) == 20, 'неверное число настроек');
    }

    public function test_can_write_settings()
    {
        $setting = Option::factory()->create();

        $value = 'new content';

        $response = $this->postJson('nova-vendor/settings', [
            $setting->key => $value,
        ]);
        $setting->refresh();

        $response->assertSuccessful();
        $this->assertTrue($setting->value == $value, 'Значение не изменилось');
    }
}
