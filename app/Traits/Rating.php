<?php

namespace App\Traits;

use App\Models\Mark;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
