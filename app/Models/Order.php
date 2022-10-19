<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const UNPAID = 'unpaid';
    public const PAID = 'paid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
    ];

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->products
                                ->sum(function($product) {
                                    return $product->price * $product->pivot->amount;
                                }),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('amount')
                    ->withTimestamps();
    }
}
