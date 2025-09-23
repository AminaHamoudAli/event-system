<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'quantity',
        'total',
        'pdf_path',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // العلاقة مع التذكرة

    public function orders() {
    return $this->hasMany(Order::class);
}

}
