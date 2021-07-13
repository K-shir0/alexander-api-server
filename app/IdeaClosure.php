<?php
namespace App;

use Franzose\ClosureTable\Models\ClosureTable;

class IdeaClosure extends ClosureTable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'idea_closure';

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
}
