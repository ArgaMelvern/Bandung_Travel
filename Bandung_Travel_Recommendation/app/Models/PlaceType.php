<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    use HasFactory;
    protected $table = 'place_types';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    public function places()
    {
        return $this->hasMany(Place::class, 'type_place_id', 'id');
    }
}
