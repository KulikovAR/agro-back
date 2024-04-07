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
                    400 => '#f2b430',
                    500 => '#f2b430',
                    600 => '#f2b430',
                    700 => '#f2b430',
                    800 => '#f2b430',
                    900 => '#f2b430',
                    950 => '#f2b430',
                ],
                'info' => [
                    50 => '#0a0a0a',
                    100 => '#0a0a0a',
                    200 => '#0a0a0a',
                    300 => '#0a0a0a',
                    400 => '#0a0a0a',
                    500 => '#0a0a0a',
                    600 => '#0a0a0a',
                    700 => '#0a0a0a',
                    800 => '#0a0a0a',
                    900 => '#0a0a0a',
                    950 => '#0a0a0a',
                ],
                'warning' => [
                    50 => '#f2b430',
                    100 => '#f2b430',
                    200 => '#f2b430',
                    300 => '#f2b430',
                    400 => '#f2b430',
                    500 => '#f2b430',
                    600 => '#f2b430',
                    700 => '#f2b430',
                    800 => '#f2b430',
                    900 => '#f2b430',
                    950 => '#f2b430',
                ],
                'success' => [
                    50 => '#66ff00',
                    100 => '#66ff00',
                    200 => '#66ff00',
                    300 => '#66ff00',
                    400 => '#66ff00',
                    500 => '#66ff00',
                    600 => '#66ff00',
                    700 => '#66ff00',
                    800 => '#66ff00',
                    900 => '#66ff00',
                    950 => '#66ff00',
                ],
                'danger' => [
                    50 => '#c10020',
                    100 => '#c10020',
                    200 => '#c10020',
                    300 => '#c10020',
                    400 => '#c10020',
                    500 => '#c10020',
                    600 => '#c10020',
                    700 => '#c10020',
                    800 => '#c10020',
                    900 => '#c10020',
                    950 => '#c10020',
                ],
            ])
            ->brandLogo(asset('images/agro-logo.png'))
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
