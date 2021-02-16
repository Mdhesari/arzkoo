<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateLandingSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('landing.categories', []);
    }
}
