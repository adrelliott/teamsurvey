<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Vinkla\Hashids\Facades\Hashids;

class Invitation extends Pivot
{
    use HasFactory;

    protected $table='participant_survey';

    // Unhash the passed string, get the first value from the resulting array & find
    public static function findByHashedId($hashId)
    {
        return Parent::find(head(Hashids::decode($hashId)));
    }

    // public static function updateByHashedId($hashId, $attributes)
    // {
    //     return Parent::update(head(Hashids::decode($hashId)));
    // }
}
