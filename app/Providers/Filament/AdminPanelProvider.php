<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => [
                    50 => '#41bbfd',
                    100 => '#41bbfd',
                    200 => '#41bbfd',
                    300 => '#41bbfd',
                    400 => '#41bbfd',
                    500 => '#41bbfd',
                    600 => '#41bbfd',
                    700 => '#41bbfd',
                    800 => '#41bbfd',
                    900 => '#41bbfd',
                    950 => '#41bbfd',
                ],
                'warning' => [
                    50 => '#41bbfd',
                    100 => '#41bbfd',
                    200 => '#41bbfd',
                    300 => '#41bbfd',
                    400 => '#41bbfd',
                    500 => '#41bbfd',
                    600 => '#41bbfd',
                    700 => '#41bbfd',
                    800 => '#41bbfd',
                    900 => '#41bbfd',
                    950 => '#41bbfd',
                ],
                'success' => [
                    50 => '#f0faff',
                    100 => '#f0faff',
                    200 => '#f0faff',
                    300 => '#f0faff',
                    400 => '#f0faff',
                    500 => '#f0faff',
                    600 => '#f0faff',
                    700 => '#f0faff',
                    800 => '#f0faff',
                    900 => '#f0faff',
                    950 => '#f0faff',
                ],
            ])
            ->brandLogo(asset('images/logo.png'))
            ->font('Open Sans')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
