<?php

namespace App\Observers;

use App\Models\Agreement;
use App\Models\Locker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AgreementObserver
{
    /**
     * Handle the Agreement "creating" event.
     */
    public function creating(Agreement $agreement): void
    {
        $startDate = Carbon::parse($agreement->start_date);
        $agreement->end_date = $startDate->copy()->addDays(365);
    }

    /**
     * Handle the Agreement "created" event.
     */
    public function created(Agreement $agreement): void
    {
        // Make locker status to "Reserved"
        Locker::where('id', $agreement->locker_id)
            ->update(['status_id' => 2]);
    }

    /**
     * Handle the Agreement "updating" event.
     */
    public function updating(Agreement $agreement): void
    {
        $startDate = Carbon::parse($agreement->start_date);
        $agreement->end_date = $startDate->copy()->addDays(365);
    }

    /**
     * Handle the Agreement "updated" event.
     */
    public function updated(Agreement $agreement): void
    {
        // Make locker status to "Reserved"
        Locker::where('id', $agreement->locker_id)
            ->update(['status_id' => 2]);
    }

    /**
     * Handle the Agreement "deleted" event.
     */
    public function deleted(Agreement $agreement): void
    {
        // Make locker status to "Available"
        Locker::where('id', $agreement->locker_id)
            ->update(['status_id' => 1]);
    }

    /**
     * Handle the Agreement "restored" event.
     */
    public function restored(Agreement $agreement): void
    {
        // Make locker status to "Reserved"
        Locker::where('id', $agreement->locker_id)
            ->update(['status_id' => 2]);
    }

    /**
     * Handle the Agreement "force deleted" event.
     */
    public function forceDeleted(Agreement $agreement): void
    {
        // Make locker status to "Available"
        Locker::where('id', $agreement->locker_id)
            ->update(['status_id' => 1]);

        Storage::delete([
            'documents/'.$agreement->agreement_proof,
        ]);
    }
}
