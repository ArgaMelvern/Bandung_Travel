<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritePlaceItems extends Model
{
    use HasFactory;
    protected $table = 'favorite_place_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'favorite_id', 'place_id'
    ];

    public function favorites()
    {
        return $this->belongsTo(Favorite::class, 'favorite_id', 'id');
    }

    public function places()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
