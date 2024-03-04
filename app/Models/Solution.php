<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solution extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
      'rank',
      'text',
    ];

    // Relationships
    public function error(): BelongsTo
    {
        return $this->belongsTo(Error::class);
    }
    // End of Relationships
}
