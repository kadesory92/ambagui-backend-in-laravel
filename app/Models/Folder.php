<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo',
        'filePassport',
        'gender',
        'residenceStatus',
        'university',
        'city',
        'address',
        'phone',
        'profession',
        'job',
        'compagny',
        'civilStatus',
        'nbChildren',

        'firstNameReferent',
        'lastNameReferent',
        'emailReferent',
        'phoneReferent',
        'familyConnection',
    ];

}
