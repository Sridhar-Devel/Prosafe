<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Models\Agreement;
use App\Models\Locker;
use App\Models\Tennure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class TennureObserver
{
    /**
     * Handle the Tennure "creating" event.
     */
    public function creating(Tennure $tennure): void
    {
        $isTennureExists = Tennure::where('agreement_id', $tennure->agreement_id)
            ->value('id');

        if ($isTennureExists !== null) {
            Tennure::select('id')
                ->where('agreement_id', $tennure->agreement_id)
                ->update([
                    'status' => StatusEnum::Inactive,
                ]);
        }

        $startDate = Carbon::parse($tennure->start_date);
        $tennure->end_date = $startDate->copy()->addDays($tennure->period);

    }

    /**
     * Handle the Tennure "created" event.
     */
    public function created(Tennure $tennure): void
    {
        Agreement::where('id', $tennure->agreement_id)
            ->update([
                'end_date' => $tennure->end_date,
            ]);

        $locker_id = Agreement::where('id', $tennure->agreement_id)
            ->value('locker_id');

        Locker::where('id', $locker_id)
            ->update([
                'status_id' => 2,
            ]);
    }

    /**
     * Handle the Tennure "updating" event.
     */
    public function updating(Tennure $tennure): void
    {
        $startDate = Carbon::parse($tennure->start_date);
        $tennure->end_date = $startDate->copy()->addDays($tennure->period);
    }

    /**
     * Handle the Tennure "updated" event.
     */
    public function updated(Tennure $tennure): void
    {
        //
    }

    /**
     * Handle the Tennure "deleted" event.
     */
    public function deleted(Tennure $tennure): void
    {
        //
    }

    /**
     * Handle the Tennure "restored" event.
     */
    public function restored(Tennure $tennure): void
    {
        //
    }

    /**
     * Handle the Tennure "force deleted" event.
     */
    public function forceDeleted(Tennure $tennure): void
    {
        Storage::delete([
            'documents/'.$tennure->payment_receipt,
        ]);
    }
}
