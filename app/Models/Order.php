<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'code',
    ];

    /**
     * The "boot" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Order $order) {
            $order->code = Str::upper(Str::random(12));
        });
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
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product_user')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    /**
     * Get all of the users for the order.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'order_product_user')
            ->withPivot('product_id')
            ->withTimestamps();
    }
}
