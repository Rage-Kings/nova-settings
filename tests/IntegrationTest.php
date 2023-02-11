<?php


namespace RageKings\NovaSettings\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;
use RageKings\NovaSettings\SettingsToolServiceProvider;

abstract class IntegrationTest extends TestCase
{
    use RefreshDatabase;

    const fake_entity_count = 5;
    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            SettingsToolServiceProvider::class,
        ];
    }

}