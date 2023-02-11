<?php


namespace RageKings\NovaSettings;

use RageKings\NovaSettings\Models\Option;

class SettingsService
{
    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null): mixed
    {
         $setting = Option::where('key', $key)->first();
         if ($setting === null || $setting->value === null || $setting->value === '')
             return $default;

        return $setting->value;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value) : void
    {
        $setting = Option::where('key', $key)->firstOrFail();
        $setting->update(['value' => $value]);
    }

    /**
     * @return array
     */
    public function syncSettings() : array
    {
        $settings = config('astreya-settings.settings', []);
        $extractedKeys = [];
        foreach ($settings as $setting) {
            $extractedKeys[] = $setting['key'];
            Option::updateOrCreate([
                'key' => $setting['key']
            ], $setting);
        }
        Option::whereNotIn('key', $extractedKeys)->delete();
        return $settings;
    }
}