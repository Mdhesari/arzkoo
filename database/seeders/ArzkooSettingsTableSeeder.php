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

        $setting = $this->findSetting('landing.title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.landing.title'),
                'value'        => __('seeders.settings.landing.title'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Landing',
            ])->save();
        }

        $setting = $this->findSetting('landing.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.landing.description'),
                'value'        => __('seeders.settings.landing.description'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Landing',
            ])->save();
        }

        $setting = $this->findSetting('landing.aboutTitle');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.landing.AboutTitle'),
                'value'        => __('seeders.settings.landing.AboutTitle'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Landing',
            ])->save();
        }

        $setting = $this->findSetting('landing.aboutDescription');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.landing.aboutDescription'),
                'value'        => __('seeders.settings.landing.aboutDescription'),
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 1,
                'group'        => 'Landing',
            ])->save();
        }

        $setting = $this->findSetting('landing.compare.bestPriceDescription');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.landing.compare.bestPriceDescription'),
                'value'        => 'در این حالت شما ارز دیجیتال خود را با قیمت پیشنهادی خودتان ثبت می کنید و
                منتظر درخواست خرید ...',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 1,
                'group'        => 'Landing',
            ])->save();
        }

        $setting = $this->findSetting('landing.compare.bestRateDescription');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.landing.compare.bestRateDescription'),
                'value'        => 'در این حالت شما ارز دیجیتال خود را با قیمت پیشنهادی خودتان ثبت می کنید و
                منتظر درخواست خرید ...',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 1,
                'group'        => 'Landing',
            ])->save();
        }

        $setting = $this->findSetting('landing.compare.bestFeatureDescription');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('seeders.settings.landing.compare.bestFeatureDescription'),
                'value'        => 'در این حالت شما ارز دیجیتال خود را با قیمت پیشنهادی خودتان ثبت می کنید و
                منتظر درخواست خرید ...',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 1,
                'group'        => 'Landing',
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
