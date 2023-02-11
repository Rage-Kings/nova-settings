<?php

namespace RageKings\NovaSettings\Tests\Unit\Service;

use RageKings\NovaSettings\Models\Option;
use RageKings\NovaSettings\SettingsService;
use RageKings\NovaSettings\Tests\IntegrationTest;
use Closure;
use Generator;

class SettingsServiceTest extends IntegrationTest
{
    /**
     * @var SettingsService
     */
    private SettingsService $service;

    private Option $option;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new SettingsService();
    }

    /**
     * @covers       \RageKings\NovaSettings\SettingsService::get
     * @dataProvider dataProvider_getSetting
     * @param \Closure $fn
     */
    public function testGet(Closure $fn)
    {
        [$option, $default, $expected_value] = $fn();
        $result_value = $this->service->get($option, $default);
        $this->assertEquals($result_value, $expected_value);
    }

    /**
     * @covers \RageKings\NovaSettings\SettingsService::set
     */
    public function testSet()
    {
        $this->option = Option::factory()->create();
        $expected_value = 'test value';
        $this->service->set($this->option->key, $expected_value);
        $result_value = $this->service->get($this->option->key);
        $this->assertEquals($result_value, $expected_value, 'Значение не изменилось');
    }

    /**
     * @dataProvider dataProvider_syncSetting
     * @covers \RageKings\NovaSettings\SettingsService::syncSettings
     */
    public function testSyncSettings(Closure $fn) {
        [$expected_options, $unexpected_options] = $fn();
        $settings = $this->service->syncSettings();
        $this->assertEquals($expected_options, $settings);
        foreach ($unexpected_options as $unexpected_option) {
            $this->assertNotContains($unexpected_option, $settings);
        }
    }

    public function dataProvider_getSetting(): Generator
    {
        yield 'should_return_default_when_value_null' => [
            'fn' => function() {
                $this->option = Option::factory()->create(['value' => null]);
                return [
                    $this->option->key,
                    'default_option',
                    'default_option'
                ];
            }
        ];

        yield 'should_return_default_when_empty_string' => [
            'fn' => function() {
                $this->option = Option::factory()->create(['value' => '']);
                return [
                    $this->option->key,
                    'default_option',
                    'default_option'
                ];
            }
        ];

        yield 'should_return_value_when_zero' => [
            'fn' => function() {
                $this->option = Option::factory()->create(['value' => 0]);
                return [
                    $this->option->key,
                    'default_option',
                    0
                ];
            }
        ];

        yield 'should_return_value_when_option_not_found' => [
            'fn' => function() {
                $this->option = Option::factory()->make();
                return [
                    $this->option->key,
                    'default_option',
                    'default_option'
                ];
            }
        ];
    }

    public function dataProvider_syncSetting(): Generator
    {
        yield 'should_delete_option' => [
            'fn' => function() {
                $option = Option::factory()->create();
                return [
                    [],                    // Expected options
                    [$option->toArray()]   // Unexpected option
                ];
            }
        ];

        yield 'should_create_option' => [
            'fn' => function() {
                /** @var Option $option */
                $option = Option::factory()->make();

                config()->set('astreya-settings.settings', [
                    [
                        'key'           => $option->key,
                        'title'         => $option->title,
                        'type'          => $option->type,
                        'description'   => $option->description,
                        'panel'         => $option->panel,
                    ],
                ]);

                $settings = config('astreya-settings.settings', []);

                return [
                    $settings,             // Expected options
                    []                     // Unexpected option
                ];
            }
        ];
    }
}