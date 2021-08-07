<?php

namespace App\Casts;

// use App\Models\Invitation as InvitationModel;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Vinkla\Hashids\Facades\Hashids;

class InvitationId implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return \App\Models\Address
     */
    public function get($model, $key, $value, $attributes)
    {
        return 'invitehashhh';
        // dd('invitatin id cast');
        // return head(Hashids::decode($value));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  \App\Models\Address  $value
     * @param  array  $attributes
     * @return array
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
