<?php


namespace RageKings\NovaSettings\Http\Controllers;

use Illuminate\Http\JsonResponse;
use RageKings\NovaSettings\Models\Option;
use RageKings\NovaSettings\SettingsService;
use Illuminate\Http\Request;

class SettingsToolController
{
    protected SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(): JsonResponse
    {
        $settings = [];
        $settings['settings'] = Option::all()->SortByDesc('order')->keyBy('key');

        foreach ($settings['settings'] as $setting) {
            if ($setting['type'] === 'toggle') {
                $setting['value'] = intval($setting['value']);
            }
            $settings['sections'][$setting->section ?? '_default']['panels'][$setting->panel ?? '_default'][] = $setting->key;
        }

        return response()->json($settings);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function write(Request $request): JsonResponse
    {
        foreach ($request->all() as $settingName => $value) {
            $this->settingsService->set($settingName, $value);
        }
        return response()->json();
    }
}
