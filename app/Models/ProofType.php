<?php

namespace App\Models;

use App\Enums\ProofCategoryEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ProofType extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'status',
    ];

    protected $casts = [
        'category' => ProofCategoryEnum::class,
        'status' => StatusEnum::class,
    ];
}
