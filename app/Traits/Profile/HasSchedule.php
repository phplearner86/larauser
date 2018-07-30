<?php  

namespace App\Traits\Profile;


trait HasSchedule
{
    public function assignSchedule($days, $starts, $ends)
    {
        $schedule = $this->getMappedCollection($days, $starts, $ends);

        if ($this->hasSchedule()) 
        {
            $this->days()->sync($schedule);
        }
        else
        {
            $this->days()->attach($schedule);
        }
    }


    protected function getMappedCollection($days, $starts, $ends)
    {
        $collection = collect($this->getMultiArray($days, $starts, $ends));

        $days = $collection->mapWithKeys(function($day)
        {
            return [
                $day['day_id'] => [
                    'start_at' => $day['start_at'],
                    'end_at' => $day['end_at'],
                ],
            ];
        });

        return $days;
    }


    protected function getMultiArray($days, $starts, $ends)
    {
        $assocArray = [];
        $multiArray = [];


        for ($i=0; $i < sizeof($days); $i++) 
        { 
            $assocArray[$i] = [
                'day_id' => $days[$i],
                'start_at' => $starts[$i],
                'end_at' => $ends[$i],
            ];

            array_push($multiArray, $assocArray[$i]);
        }

        return $multiArray;
    }
}