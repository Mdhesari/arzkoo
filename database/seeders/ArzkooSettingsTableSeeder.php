<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class ArzkooSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = $this->findSetting('footer.info');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.footer.info'),
                'value'        => __('seeders.settings.footer.info'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Footer',
            ])->save();
        }

        $setting = $this->findSetting('footer.copyright');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.footer.copyright'),
                'value'        => __('seeders.settings.footer.copyright'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Footer',
            ])->save();
        }

        $setting = $this->findSetting('footer.mainMenuTitle');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.footer.mainMenuTitle'),
                'value'        => __('seeders.settings.footer.mainMenuTitle'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Footer',
            ])->save();
        }
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
