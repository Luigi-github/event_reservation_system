<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $fillable = [
        'user_id',
        'event_id'
    ];


    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function user(){
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public static function countAttendee($dto){
        return DB::table('tickets')
            ->distinct('user_id')
            ->where('event_id', $dto['event_id'])
            ->count();
    }
}
