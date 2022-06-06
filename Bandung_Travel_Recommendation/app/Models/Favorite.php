<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id'
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function favorite_place_items()
    {
        return $this->hasMany(FavoritePlaceItems::class, 'favorite_id', 'id');
    }
    public function places()
    {
        return $this->belongsToMany(Place::class, FavoritePlaceItems::class, 'favorite_id', 'place_id');
    }
}
