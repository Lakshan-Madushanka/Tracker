<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @method \string getKey()
 */
class Category extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function errors(): HasMany
    {
        return $this->hasMany(Error::class);
    }
    // End of Relationships
}
