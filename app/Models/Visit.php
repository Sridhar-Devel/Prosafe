<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Visit extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'time_in',
        'time_out',
        'customer_id',
        'customer1_photo',
        'customer2_id',
        'customer2_photo',
        'customer3_id',
        'customer3_photo',
        'locker_id',
        'user_id',
    ];

    /**
     * Get the customer that owns the Visit
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the customer2 that owns the Visit
     */
    public function customer2(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the customer3 that owns the Visit
     */
    public function customer3(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the locker that owns the Visit
     */
    public function locker(): BelongsTo
    {
        return $this->belongsTo(Locker::class);
    }

    /**
     * Get the user that owns the Visit
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array<int, string>
     */
    public static function locker_search(): array
    {
        $lockers = Locker::where('status_id', '=', 2)->get();

        $locker_options = [];

        foreach ($lockers as $locker) {
            $data = 'L'.$locker->number.' | '.$locker->floor->name;
            $locker_options[$locker->id] = $data;
        }
        asort($locker_options);

        return $locker_options;
    }
}
