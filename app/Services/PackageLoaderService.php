<?php

namespace App\Services;

class PackageLoaderService
{
    public static function menuPackages()
    {
        $packagesList = array_pluck(config('packages'), 'name');
        foreach ($packagesList as $package) {
            $items[] = [
                'url' => route(config('packages.' . $package . '.menu.url')),
                'caption' => config('packages.' . $package . '.menu.caption'),
                'icon' => config('packages.' . $package . '.menu.icon'),
                'active' => config('packages.' . $package . '.menu.active'),
            ];
        }

        return $items;
    }

    public static function menuSettings()
    {
        $settingsList = array_pluck(config('packages'), 'name');
        foreach ($settingsList as $settings) {
            $setting[] = [
                'url' => route(config('packages.' . $settings . '.menu-settings.url')),
                'caption' => config('packages.' . $settings . '.menu-settings.caption'),
                'icon' => config('packages.' . $settings . '.menu-settings.icon'),
                'active' => config('packages.' . $settings . '.menu-settings.active'),
            ];
        }

        return $setting;
    }
}
