<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecoverCodes extends Model
{
    use HasFactory;

    protected $table = 'recover_codes';

    protected $fillable = [
        'userid',
        'code',
        'type',
        'status',
    ];
}
