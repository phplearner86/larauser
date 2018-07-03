<?php

namespace App\Http\Controllers;

use App\Day;
use App\DayProfile;
use App\Http\Requests\DaysRequest;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function test($userId)
    {
        $user = User::find($userId);
        return view('test', compact('user'));
    }

    public function upgrade(Request $request, $userId)
    {
        $user = User::whereId($userId)->first();
        $profile = $user->profile;
        $subjects = $request->subject_id;
        //return $subjects;
        $profile->subjects()->attach($subjects);

        return response(['profiles'=> $profile->load('subjects')]);
    }

    public function deleteall($userId)
    {
        $user = User::whereId($userId)->first();
        $profile = $user->profile;
        
        $profile->subjects()->detach();
        return back();
    }

    public function show($userId)
    {
        $user = User::whereId($userId)->first();
        $profile = $user->profile;
        $subjects = $profile->subjects;
        return $subjects;
    }

    public function update(Request $request, $userId)
    {
        $user = User::whereId($userId)->first();
        $profile = $user->profile;
        $subjects = $request->subject_id;
        //return $subjects;
        $profile->subjects()->sync($subjects);
        //$profile->subjects()->detach();
        //$profile->subjects()->attach($subjects);

        return response(['profiles'=> $profile->load('subjects')]);
    }

    public function showDays(Profile $profile)
    {
       $all_days = Day::all();
        $days = $profile->days;
        return response([ 'mydays' => $days, 'alldays' => $all_days]);
    }


    public function getDays(Profile $profile)
    {
        $days = Day::all();
        return view('days', compact('profile', 'days'));
    }

    // public function createSchedule(Request $request, Profile $profile)
    // {
    //     $pivots = ['start'];
    //     $days =  $request->day;
    //     $dayIds = [];

    //     $collection = collect($days);

    //     $keyed = $collection->mapWithKeys(function ($item) use($pivots) {
    //         for ($i=0; $i < sizeof($pivots); $i++) 
    //         { 
    //             if ($item['day_id']) {
    //                 return [$item['day_id'] => [
    //                     $pivots[$i] => $item[$pivots[$i]],
    //                 ]];
    //             }
    //         }
    //     });

    //     $keyed->all();

    //     $profile->days()->sync($keyed);

    //     return back();


    //     for ($i=0; $i < sizeof($days) ; $i++) { 
    //         array_push($dayIds, $days[$i]['day_id']);

    //     }

    
    //      $array = [
    //         'mon' => [
    //             'start' => 10,
    //             'end' => 11,
    //         ],
    //         'tue' => [
    //             'start' => 2,
    //             'end' => 4,
    //         ]
    //      ];
    
    //     for ($i=0; $i < sizeof($days); $i++) 
    //     { 
    //         $profile->days()->attach($days[$i]['day_id'], ['start' => $days[$i]['start']]);
    //     }
    //    return back();
    // }
    // 
    
    public function createSchedule(DaysRequest $request, Profile $profile)
    {
        return $request->all();
        
         $days =  $request->except('_token');
        // return sizeof($days);
         $keys = [];
        //return $days['day'][0];
        for ($i=0; $i < sizeof($days['day']); $i++) 
        { 
            $a = [
                'day_id' => $days['day'][$i], 
                'start' => $days['start'][$i], 
                'end' => $days['end'][$i]
            ];

            if ($a[$i]['day_id']) {
                array_push($keys, $a);
            }

        }

        if ($profile->days->count()) 
         {
            $profile->days()->sync($keys);
         }
         else
         {
            $profile->days()->attach($keys);
         }

         return back();
        
        // $array = $request->day;
        // $fields = ['day_id', 'start', 'end'];
        // $days = [];
        // //return $array;

        // for ($i=0; $i < sizeof($array); $i++) 
        // { 
        //     if (array_key_exists (  'day_id' , $array[$i] ) !=null) 
        //     {
        //         array_push($days, $array[$i]);
        //     }
        // }

        //  $daysCol = collect($days);

        //  $daysCol->mapWithKeys(function ($day){
            
        //     return [$day['day_id'] => [
        //             'start' => $day['start'],
        //             'end' => $day['end'],
        //         ]
        //     ];
        //  });

        //  if ($profile->days->count()) 
        //  {
        //     $profile->days()->sync($daysCol->all());
        //  }
        //  else
        //  {
        //     $profile->days()->attach($daysCol->all());
        //  }
         
        //  return back();
     }

     public function editDays(Profile $profile)
     {
        $days = Day::all();
        //return $profile->days->pivot;
        return view('dayedit', compact('days', 'profile'));
     }

     public function updateDays(Request $request, Profile $profile)
     {
        $days =  $request->except('_token');
        // return sizeof($days);
         $keys = [];
        //return $days['day'][0];
        for ($i=0; $i < sizeof($days['day']); $i++) 
        { 
            $a = [
                'day_id' => $days['day'][$i], 
                'start' => $days['start'][$i], 
                'end' => $days['end'][$i]
            ];
           array_push($keys, $a);
        }

        if ($profile->days->count()) 
         {
            $profile->days()->sync($keys);
         }
         else
         {
            $profile->days()->attach($keys);
         }

         return back();
     }
}
