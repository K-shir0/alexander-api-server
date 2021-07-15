<?php
namespace App;

use App\Models\Space;
use App\Models\User;
use Franzose\ClosureTable\Models\Entity;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function spaces(): BelongsToMany
    {
        return $this->belongsToMany(Space::class, 'space_idea');
    }
}
