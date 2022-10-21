<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kids_profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_profile_id',
        'kid_name',
        'kid_surname',
        'date_of_birth',
        'additional_information'

    ];
}
