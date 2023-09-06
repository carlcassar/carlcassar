<?php

namespace App\Models;

use Illuminate\Support\Collection;

class NotificationSettings
{
    public const ACCOUNT_NOTIFICATIONS = 'account_related_notifications';

    public const NEW_ARTICLE_PUBLISHED = 'new_article_published';

    public const ANNOUNCEMENTS = 'announcements';

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

    public function isOn(string $notification): bool
    {
        return $this->get($notification) == true;
    }

    public function areAllOn(): bool
    {
        return self::defaultNotificationSettings()
            ->map(fn () => false)
            ->merge($this->all())
            ->every(fn ($notification) => $notification == true);
    }

    public static function defaultNotificationSettings(): Collection
    {
        return collect([
            self::ACCOUNT_NOTIFICATIONS => true,
            self::NEW_ARTICLE_PUBLISHED => true,
            self::ANNOUNCEMENTS => true,
        ]);
    }

    public function all(): Collection
    {
        return collect($this->settings->get('notifications'));
    }
}
