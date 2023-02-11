<?php

namespace RageKings\NovaSettings;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Laravel\Nova\Menu\MenuSection;

class SettingsTool extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::script('settings', __DIR__ . '/../public/js/tool.js');
        Nova::style('settings', __DIR__ . '/../public/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View|string
     */
    public function renderNavigation(): string|View
    {
        return view('settings::navigation');
    }


    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MenuSection
     */
    public function menu(Request $request): MenuSection
    {
        return MenuSection::make('Settings')
            ->path('/settings')
            ->icon('server');
    }
}
