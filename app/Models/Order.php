<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'details'
    ];

    /**
     * Generate a new UUID for the model.
     */
    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    /**
     * Get the user that owns the order.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the products for the order.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'user_id')
            ->withTimestamps();
    }

    /**
     * Get all of the allowed products for the order.
     *
     * @return BelongsToMany
     */
    public function allowedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'allowed_products')
            ->withTimestamps();
    }

    /**
     * Get the products summary for the order.
     *
     * @return Collection
     */
    public function productsSummary(): Collection
    {
        return $this->products
            ->groupBy('id')
            ->map(function ($productGroup) {
                return [
                    'id' => $productGroup[0]->id,
                    'name' => $productGroup[0]->name,
                    'quantity' => $productGroup->sum('pivot.quantity')
                ];
            })
            ->values();
    }
}
