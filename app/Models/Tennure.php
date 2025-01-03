<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Tennure extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'agreement_id',
        'start_date',
        'end_date',
        'period',
        'invoice_no',
        'payment_receipt',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the agreement that owns the Tennure
     */
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }

    /**
     * @return array<int, string>
     */
    public static function agreement_search(): array
    {
        $agreements = Agreement::all();
        $agreement_options = [];

        foreach ($agreements as $agreement) {
            $data = $agreement->agreement_no.' | L'.$agreement->locker->number.' - '.$agreement->locker->floor->name.' | '.$agreement->customer1->customer_name;
            $agreement_options[$agreement->id] = $data;
        }
        asort($agreement_options);

        return $agreement_options;
    }
}
