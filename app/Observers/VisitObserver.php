<?php

namespace App\Observers;

use App\Mail\Visit as MailVisit;
use App\Models\Visit;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VisitObserver
{
    /**
     * Handle the Visit "created" event.
     */
    public function created(Visit $visit): void
    {
        // if ($visit->customer_id) {
        //     Mail::to($visit->customer->email)
        //         ->send(new MailVisit($visit));
        // }

        // if ($visit->customer2_id) {
        //     Mail::to($visit->customer2->email)
        //         ->send(new MailVisit($visit));
        // }

        // if ($visit->customer3_id) {
        //     Mail::to($visit->customer3->email)
        //         ->send(new MailVisit($visit));
        // }
    }

    /**
     * Handle the Visit "updating" event.
     */
    public function updating(Visit $visit): void
    {
        if ($visit->time_out) {
            $visit->time_out = Carbon::now()->format('Y-m-d H:i:s');

            Notification::make()
                ->title('Out time recorded successfully')
                ->body('Visit out time is recorded at '.$visit->time_out)
                ->success()
                ->send();
        }

    }

    /**
     * Handle the Visit "updated" event.
     */
    public function updated(Visit $visit): void
    {
        //
    }

    /**
     * Handle the Visit "deleted" event.
     */
    public function deleted(Visit $visit): void
    {
        //
    }

    /**
     * Handle the Visit "restored" event.
     */
    public function restored(Visit $visit): void
    {
        //
    }

    /**
     * Handle the Visit "force deleted" event.
     */
    public function forceDeleted(Visit $visit): void
    {
        Storage::delete([
            'documents/'.$visit->customer1_photo,
            'documents/'.$visit->customer2_photo,
            'documents/'.$visit->customer3_photo,
        ]);
    }
}
