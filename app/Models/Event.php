<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'price',
        'attendee_limit'
    ];

    public static function attendee_limit($id){
        return DB::table('events')->select('attendee_limit')->where('id', $id)->first();
    }
}
