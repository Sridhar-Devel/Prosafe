<?php

namespace App\Models;

use App\Enums\CustomerGenderEnum;
use App\Enums\CustomerTitleEnum;
use App\Enums\GuardianEnum;
use App\Enums\MaritalStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_title',
        'customer_name',
        'occupation',
        'guardian',
        'guardian_title',
        'guardian_name',
        'dob',
        'gender',
        'nationality',
        'marital_status',
        'email',
        'phone',
        'phone2',
        'residence_landline',
        'pa_door_no',
        'pa_street_name',
        'pa_city',
        'pa_state_id',
        'pa_pincode',
        'ca_door_no',
        'ca_street_name',
        'ca_city',
        'ca_state_id',
        'ca_pincode',
        'same_address',
        'pan_card_no',
        'identity_proof_id',
        'address_proof_id',
        'customer_photo',
        'customer_sign',
        'proof_of_address',
        'proof_of_identity',
        'identity_proof_no',
        'address_proof_no',
    ];

    protected $casts = [
        'dob' => 'date',
        'customer_title' => CustomerTitleEnum::class,
        'gender' => CustomerGenderEnum::class,
        'guardian_title' => CustomerTitleEnum::class,
        'marital_status' => MaritalStatusEnum::class,
        'guardian' => GuardianEnum::class,
    ];

    /**
     * * Get the visits for this Customer
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    /**
     * * Get the pa_state for this Customer
     */
    public function pa_state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'pa_state_id');
    }

    /**
     * * Get the ca_state for this Customer
     */
    public function ca_state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'ca_state_id');
    }

    /**
     * * Get the pa_state for this Customer
     */
    public function identity_proof_list(): BelongsTo
    {
        return $this->belongsTo(ProofType::class, 'identity_proof_id');
    }

    /**
     * * Get the ca_state for this Customer
     */
    public function address_proof_list(): BelongsTo
    {
        return $this->belongsTo(ProofType::class, 'address_proof_id');
    }
}
