<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'description',
    //     'organizer_id',
    //     'start_date',
    //     'end_date',
    //     'location',
    // ];
    protected $fillable = [
    'title',
    'description',
    'organizer_id',
    'start_date',
    'end_date',
    'location',
];


    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id');
    }
    

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function files() {
        return $this->hasMany(File::class);
    }
    protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
];

}


