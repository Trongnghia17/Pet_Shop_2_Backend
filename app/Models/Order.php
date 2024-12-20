<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItems;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'amount',
        'address',
        'payment_mode',
        'tracking_no',
    ];
    protected $with = ['orderItems'];
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}
