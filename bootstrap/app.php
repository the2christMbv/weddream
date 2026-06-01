<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth; // <-- TRÈS IMPORTANT : Ajout de cet import pour analyser l'utilisateur

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // CORRECTION DE LA REDIRECTION LARAVEL 11
        // Quand un utilisateur connecté tente d'aller sur /login ou /, ce bloc décide de son sort
        $middleware->redirectGuestsTo(fn () => route('login'));
        
        $middleware->redirectUsersTo(function () {
            if (Auth::check()) {
                $user = Auth::user();
                
                // 1. Le Super Admin va sur son tableau de bord global
                if ($user->role === 'super_admin') {
                    return route('admin.dashboard');
                }
                
                // 2. Le Superviseur (Herdy) va sur son plan de salle Jour J
                if ($user->role === 'supervisor') {
                    return route('supervisor.dashboard', ['id' => $user->wedding_id]);
                }
                
                // 3. Par défaut, les mariés (clients) vont sur leur gestionnaire
                return route('client.dashboard');
            }
            
            return route('login');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();