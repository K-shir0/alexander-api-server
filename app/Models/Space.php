<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function user() {
        $this->belongsTo(User::class);
    }
}
