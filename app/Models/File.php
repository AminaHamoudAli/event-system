<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'file_path',
        'file_type',
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
    public function getFileUrlAttribute() {
    return asset('storage/' . $this->file_path);
}

}

