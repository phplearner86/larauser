<?php

namespace App\Http\Controllers\Profile;

use App\Day;
use App\Http\Controllers\Controller;
use App\Http\Requests\DaysRequest;
use App\Profile;
//use Illuminate\Http\Request;

class DaysController extends Controller
{
    public function update(DaysRequest $request, Profile $profile)
    {
        $profile->assignSchedule($request->day, $request->start, $request->end);

        return message('Done');
    }

    
}
