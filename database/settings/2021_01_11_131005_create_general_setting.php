<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSetting extends SettingsMigration
{
    public function up(): void
    {
        $app_settings = config('app_settings.general');

        $this->migrator->add('general.site_name', $app_settings['name']);
        $this->migrator->add('general.site_description', $app_settings['description']);
        $this->migrator->add('general.site_logo', $app_settings['logo_url']);
        $this->migrator->add('general.site_favicon', $app_settings['favicon_url']);
    }
}
