<?php


namespace RageKings\NovaSettings\Tests\Feature\Commands;


use RageKings\NovaSettings\Commands\SyncCommand;
use RageKings\NovaSettings\SettingsService;
use RageKings\NovaSettings\Tests\IntegrationTest;

class SyncCommandTest extends IntegrationTest
{
    public function test_it_should_be_execute() {
        $command = new SyncCommand();
        $command->handle(app()->get(SettingsService::class));
    }
}