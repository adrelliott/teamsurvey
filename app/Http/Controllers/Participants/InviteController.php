<?php

namespace App\Http\Controllers\Participants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return 'this is invite controller';
    }
}
