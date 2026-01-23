<?php

namespace App\Models;

use Arr;

class Settings
{
    public function __construct(protected User $user, protected ?string $key = null) {}

    public function all()
    {
        return $this->user->getAttribute('settings');
    }

    public function get(?string $key = null)
    {
        return Arr::get($this->user->getAttribute('settings'), $key);
    }

    public function set(array|string $param, $value = null)
    {
        if (is_array($param)) {
            return $this->user->update([
                'settings' => $param,
            ]);
        }

        $settings = $this->user->settings;

        Arr::set($settings, $param, $value);

        $this->user->update([
            'settings' => $settings,
        ]);
    }

    public function notifications(): NotificationSettings
    {
        return new NotificationSettings($this);
    }
}
