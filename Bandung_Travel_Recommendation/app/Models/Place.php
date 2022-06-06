<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $table = 'places';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'type_place_id', 'rate', 'description', 'image_name', 'alamat', 'latitude', 'longitude'
    ];

    public function place_types()
    {
        return $this->belongsTo(PlaceType::class, 'type_place_id', 'id');
    }
    
    public function favorite_place_items()
    {
        return $this->hasMany(FavoritePlaceItems::class, 'place_id', 'id');
    }

    public function user_interact_logs()
    {
        return $this->hasMany(UserInteractLogs::class, 'place_id', 'id');
    }
}
