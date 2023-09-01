<?php

namespace App\Models;

class NotificationSettings
{
    public const NEW_ARTICLE_PUBLISHED = 'new_article_published';

    public function __construct(protected Settings $settings)
    {
    }

    public function toggle(string $notification): void
    {
        $value = $this->settings->get("notifications.$notification");

        $this->set($notification, ! $value);
    }

    public function get(string $notification): bool
    {
        return (bool) $this->settings->get("notifications.$notification");
    }

    public function set(string $notification, $value): void
    {
        $this->settings->set("notifications.$notification", $value);
    }

    public function turnOff(string $notification): void
    {
        $this->set($notification, false);
    }

    public function turnOn(string $notification): void
    {
        $this->set($notification, true);
    }

    public function areAllOn(): bool
    {
        return collect($this->all())->every(fn ($notification) => $notification == true);
    }

    public function all()
    {
        return $this->settings->get('notifications');
    }
}
