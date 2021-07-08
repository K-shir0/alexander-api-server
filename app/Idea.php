<?php
namespace App;

use Franzose\ClosureTable\Models\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Idea extends Entity
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ideas';

    /**
     * ClosureTable model instance.
     *
     * @var \App\IdeaClosure
     */
    protected $closure = 'App\IdeaClosure';
}
