<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait FileMorphRelation
{
    public function files(): MorphMany
    {  
        return $this->morphMany(File::class, 'fileble');
    }
    public function file(): MorphOne
    {  
        return $this->morphOne(File::class, 'fileble');
    }


}