<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class RequestLogger extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'reguest_logger';


    protected $fillable = [
        'ip',
        'url',
        'status_code',
        'method',
        'body'
        
    ];
}
