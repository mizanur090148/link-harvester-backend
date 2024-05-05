<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['domain_id', 'url'];

    /**
     * Define a relationship with the Domain model.
     *
     * @return BelongsTo
     */
    public function belongsTo(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }
}
