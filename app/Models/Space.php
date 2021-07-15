<?php

namespace App\Models;

use App\Idea;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
    ];

    public function user(): BelongsTo
    {
       return  $this->belongsTo(User::class);
    }

    public function ideas(): BelongsToMany
    {
        return $this->belongsToMany(Idea::class, 'space_idea');
    }
}
