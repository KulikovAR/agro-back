<?php

namespace App\Traits;

trait ViewsIncrementable
{   
    public function viewsCount()
    {   
        $this->all_time_views++;
        $this->views_today++;
        $this->save();
    }

    public function viewsTodayReset(){
        $this -> update([
            'views_today' => 0
        ]);
    }
}