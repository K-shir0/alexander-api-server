<?php
namespace App;

use App\Models\User;
use Franzose\ClosureTable\Models\Entity;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Idea extends Entity
{
    use HasFactory, Notifiable;
    use Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ideas';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'title',
    ];


    /**
     * ClosureTable model instance.
     *
     * @var \App\IdeaClosure
     */
    protected $closure = 'App\IdeaClosure';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
