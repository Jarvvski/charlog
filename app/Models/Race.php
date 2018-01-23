<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Log;

class Race extends Model
{
    use Sortable;

    /**
     * The sortable attributes for this model.
     * 
     * @var string
     */
    public $sortable = [
        'name', 'health_bonus'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'races';

    /**
     * 
     */
    protected $fillable = [
        'name', 'health_bonus'
    ];

    /**
     * The attributes that are computed
     * 
     * @var array
     */
    protected $appends = [
        'total_experience', 'total_dice'
    ];

    public function characters()
    {
        return $this->hasMany('App\Models\Character');
    } 
}
