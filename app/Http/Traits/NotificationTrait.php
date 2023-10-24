<?php

namespace App\Http\Traits;

use WireUi\Traits\Actions;

trait NotificationTrait
{
    use Actions;

    /**
     * Send modal notification to user.
     */
    public function sendNotification(string $title, string $icon, int $timeout = 2000): void
    {
        $this->notification()->send(
            [
                'title' => $title,
                'icon' => $icon,
                'timeout' => $timeout,
            ]
        );
    }
}
