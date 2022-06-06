<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInteractLogs extends Model
{
    use HasFactory;
    protected $table = 'user_interact_logs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'place_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function places()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
