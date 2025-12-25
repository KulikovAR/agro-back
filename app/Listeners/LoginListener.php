<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Models\User;
use App\Models\UserLoginHistory;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LoginListener
{

    public function handle(Login $event)
    {
        $now = Carbon::now();
        UserLoginHistory::create([
            'user_id' => $event->user->id,
            'login_at' => $now,
            'login_ip' => request()->getClientIp()
        ]);

        $user = User::query()->find($event->user->id);
        $user->last_login_at = $now;
        $user->save();
    }

}
