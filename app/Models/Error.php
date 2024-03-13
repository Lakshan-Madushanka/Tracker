<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $project_name
 * @property string $project_url
 * @property string $stack_trace
 * @property string $category_id
 *
 * @method \string getKey()
 */
class Error extends Model
{
    use HasFactory;
    use HasUlids;

    protected $perPage = 10;

    protected $fillable = [
        'name',
        'project_name',
        'project_url',
        'stack_trace',
        'category_id'
    ];


    // Relationships

    /**
     * @return BelongsTo<Category, Error>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class);
    }
    // End of Relationships
}
