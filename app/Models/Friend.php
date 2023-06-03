<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $primaryKey = ['friendind_user_id', 'friended_user_id'];
    public $incrementing = false;
    protected $table = 'friends';

    protected $fillable = [
        'friendind_user_id',
        'friended_user_id'
    ];
}
