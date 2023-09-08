<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'sender_user_id',
        'reciever_user_id',
        'message',
    ];

    use HasFactory;

}
