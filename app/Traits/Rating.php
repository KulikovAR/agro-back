<?php

namespace App\Traits;

use App\Models\File;
use App\Models\Mark;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

trait Rating
{
    

    public function marks(): MorphMany
    {
        return $this->morphMany(Mark::class, 'markable');
    }
    public function addMark(array $request): Mark
    { 
        return $this->marks()->updateOrCreate(['user_id' => $request['user_id']], ['estimation' => $request['estimation'], 'review' => $request['review'], 'user_id' => $request['user_id']]);
    }
    public function getOverallRating(): float
    {
        if ($this->marks()->count() != 0) {
            return round($this->marks()->sum('estimation') / $this->marks()->count(), 2);
        }
        return 0;
    }

    public function removeMark($user_id): bool
    {
        return $this->marks()->where('user_id', $user_id)->delete();
    }
}
