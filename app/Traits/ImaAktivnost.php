<?php

namespace App\Traits;

use Spatie\Activitylog\Traits\LogsActivity;

trait ImaAktivnost
{
    use LogsActivity;

    public function getDescriptionForEvent(string $eventName): string
    {
        return __($eventName) . " | :subject." . $this->naziv . " | :causer.ime";
    }
}
