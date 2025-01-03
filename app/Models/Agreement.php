<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Agreement extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'agreement_no',
        'locker_id',
        'status',
        'start_date',
        'end_date',
        'operation_type',
        'customer_count',
        'agreement_proof',
        'customer_id_1',
        'customer_id_2',
        'customer_id_3',
        'nominee_name',
        'nominee_relationship',
        'nominee_phone_no',
        'nominee_email',
        'is_non_individual',
        'business_gst_no',
        'business_pan_no',
        'business_address',
        'board_resolution',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_non_individual' => 'boolean',
    ];

    /**
     * Get the locker that owns the Agreement
     */
    public function locker(): BelongsTo
    {
        return $this->belongsTo(Locker::class);
    }

    /**
     * Get the customer that owns the Agreement
     */
    public function customer1(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id_1');
    }

    public function customer2(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id_2');
    }

    public function customer3(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id_3');
    }

    /**
     * Get all of the tennures for the Agreement
     */
    public function tennures(): HasMany
    {
        return $this->hasMany(Tennure::class);
    }

    /**
     * @return array<int, string>
     */
    public static function customer_search(): array
    {
        $customers = Customer::all();
        $customer_options = [];

        foreach ($customers as $customer) {
            $data = $customer->customer_title->name.'.'.$customer->customer_name.' | '.$customer->email.' | '.$customer->phone;
            $customer_options[$customer->id] = $data;
        }
        asort($customer_options);

        return $customer_options;
    }

    /**
     * @return array<int, string>
     */
    public static function locker_search(?string $agreement_no): array
    {
        $agreement = Agreement::where('agreement_no', $agreement_no)->first();

        if ($agreement) {
            $lockers = Locker::where('id', $agreement->locker_id)->get();
        } else {
            $lockers = Locker::where('status_id', 1)->get();
        }
        $locker_options = [];

        foreach ($lockers as $locker) {
            $data = 'L'.$locker->number.' | '.$locker->floor->name.' | '.$locker->locker_type->name;
            $locker_options[$locker->id] = $data;
        }
        asort($locker_options);

        return $locker_options;
    }
}
