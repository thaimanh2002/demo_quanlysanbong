<?php

namespace App\Observers;

use App\Events\PitchTypeChangeEvent;
use App\Models\PitchType;

class PitchTypeObserver
{
    /**
     * Handle the PitchType "created" event.
     */
    public function created(PitchType $pitchType): void
    {
        //
    }

    /**
     * Handle the PitchType "updated" event.
     */
    public function updated(PitchType $pitchType): void
    {
        event(new PitchTypeChangeEvent($pitchType, 'pitchType-updated'));
    }

    /**
     * Handle the PitchType "deleted" event.
     */
    public function deleted(PitchType $pitchType): void
    {
        //
    }

    /**
     * Handle the PitchType "restored" event.
     */
    public function restored(PitchType $pitchType): void
    {
        //
    }

    /**
     * Handle the PitchType "force deleted" event.
     */
    public function forceDeleted(PitchType $pitchType): void
    {
        //
    }
}
