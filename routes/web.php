<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SuperAdminController,
    WeddingController,
    SupervisorController,
    ProfileController,
    ProgramController,
    InvitationController,
    EventMasterController
};
use App\Http\Controllers\Admin\MagazineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// --- ACCUEIL (Avec redirection dynamique par rôle) ---
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        // 1. Si c'est le Super Admin
        if ($user->role === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. Si c'est un Superviseur
        if ($user->role === 'supervisor') {
            return redirect()->route('supervisor.dashboard', ['id' => $user->wedding_id]);
        }

        // 3. Si c'est un Serveur ou Staff d'accueil
        if (in_array($user->role, ['server', 'staff'])) {
            return redirect()->route('server.dashboard', ['id' => $user->wedding_id]);
        }

        // 4. Par défaut (Les Mariés / Clients)
        return redirect()->route('client.dashboard');
    }
    return view('welcome');
});

// --- AUTHENTIFICATION ---
Route::get('/login', fn() => view('auth.login'))->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        $user = Auth::user();

        if ($user->role === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->role === 'supervisor') {
            return redirect()->route('supervisor.dashboard', ['id' => $user->wedding_id]);
        }

        if (in_array($user->role, ['server', 'staff'])) {
            return redirect()->route('server.dashboard', ['id' => $user->wedding_id]);
        }
        
        return redirect()->route('client.dashboard');
    }
    
    return back()->withErrors(['email' => 'Identifiants incorrects.'])->onlyInput('email');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


// --- LOGIQUE DE MOT DE PASSE OUBLIÉ ---
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [Illuminate\Auth\Notifications\ResetPassword::class, 'toMail'])
    ->middleware('guest')
    ->name('password.email');


// --- ROUTES PUBLIQUES ---
Route::get('/guest/welcome/{token}', [InvitationController::class, 'guestWelcome'])->name('guest.welcome');
Route::get('/guest/rsvp/{token}', [InvitationController::class, 'rsvpForm'])->name('guest.rsvp.form');
Route::post('/guest/rsvp/{token}', [InvitationController::class, 'rsvpSubmit'])->name('guest.rsvp.submit');

// --- ESPACES PROTÉGÉS ---
Route::middleware(['auth'])->group(function () {

    // 1. ESPACE SUPER ADMIN
    Route::prefix('admin')->group(function () {
        Route::get('/', [SuperAdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/store', [SuperAdminController::class, 'store'])->name('admin.wedding.store');
        Route::put('/wedding/{id}', [SuperAdminController::class, 'update'])->name('admin.wedding.update');
        
        // --- SECTION MAGAZINE SOUVENIR ---
        Route::get('/magazine', [MagazineController::class, 'index'])->name('admin.magazine.index');
        Route::get('/magazine/download/photo', [MagazineController::class, 'downloadPhoto'])->name('admin.magazine.download-photo');
        Route::get('/magazine/{wedding}', [MagazineController::class, 'show'])->name('admin.magazine.show');
    });

    // ALIAS DE SECOURS
    Route::get('/admin/magazine-fallback', function () {
        return redirect()->route('admin.magazine.index');
    })->name('admin.magazine');

    // 2. ESPACE MARIÉS (Client)
    Route::prefix('mon-mariage')->group(function () {
        // Dashboard
        Route::get('/', [WeddingController::class, 'show'])->name('client.dashboard');
        
        // Équipe / Staff
        Route::get('/equipe', [SupervisorController::class, 'index'])->name('client.staff.index');
        Route::post('/equipe/store', [SupervisorController::class, 'store'])->name('client.staff.store');
        Route::post('/staff/reset/{id}', [SupervisorController::class, 'resetPassword'])->name('client.staff.reset');
        Route::delete('/staff/{id}', [SupervisorController::class, 'destroy'])->name('client.staff.destroy');
        // Impression pour table
        Route::get('/staff/table/{id}/print', [SupervisorController::class, 'printTableTicket'])->name('client.staff.table.print');
        // Invitations (Gestion & CRUD)
        Route::get('/invitations/gestion', [InvitationController::class, 'index'])->name('invitations.index');
        Route::post('/invitations/store', [InvitationController::class, 'store'])->name('invitations.store');
        Route::delete('/invitations/{id}', [InvitationController::class, 'destroy'])->name('invitations.destroy');
        Route::get('/invitation/{id}/print', [InvitationController::class, 'print'])->name('invitation.print');
        
        // Personnalisation des Invitations
        Route::get('/invitation/selection-modeles', [InvitationController::class, 'selectionModeles'])->name('client.invitation.selection-modeles');
        Route::post('/invitation/save-settings', [InvitationController::class, 'saveSettings'])->name('client.invitation.save-settings');

        // Programme
        Route::get('/wedding/{wedding}/program', [ProgramController::class, 'index'])->name('wedding.program.index');
        Route::post('/wedding/{wedding}/program', [ProgramController::class, 'store'])->name('wedding.program.store');
    });
    
    // 3. ESPACE SUPERVISOR (Pilotes Jour J)
    Route::prefix('supervisor')->group(function () {
        Route::post('/wedding/{wedding}/drinks', [WeddingController::class, 'storeDrink'])->name('supervisor.drinks.store');
        
        // Pilotage Jour J (EventMasterController)
        Route::get('/dashboard/{id}', [EventMasterController::class, 'dashboard'])->name('supervisor.dashboard');
        Route::post('/store-table', [EventMasterController::class, 'storeTable'])->name('supervisor.tables.store');
        Route::post('/check-in/{id}', [EventMasterController::class, 'checkIn'])->name('supervisor.checkin');
        Route::delete('/tables/remove/{id}', [EventMasterController::class, 'removeTable'])->name('supervisor.tables.remove');
        Route::get('/check-in-qr/{token}', [EventMasterController::class, 'checkInQr'])->name('supervisor.checkin.qr');
        
        // NOUVELLE ROUTE D'ASSIGNATION AJAX NETTOYÉE
        Route::post('/assign-table', [EventMasterController::class, 'assignTable'])->name('supervisor.assignTable');
        // Impression pour table
        Route::get('/staff/table/{id}/print', [SupervisorController::class, 'printTableTicket'])->name('client.staff.table.print');
        // Gestion de l'Équipe depuis l'espace Superviseur
        Route::post('/staff/store', [SupervisorController::class, 'store'])->name('supervisor.staff.store');
        Route::post('/staff/reset/{id}', [SupervisorController::class, 'resetPassword'])->name('supervisor.staff.reset');
        Route::delete('/staff/destroy/{id}', [SupervisorController::class, 'destroy'])->name('supervisor.staff.destroy');

        // --- SECTION BORNE QR (Mises à jour et préservées) ---
        Route::get('/admin/weddings/{id}/borne-qr', [SuperAdminController::class, 'generateBorneQr'])->name('admin.wedding.borne.qr');
        
        // Cette route prend désormais le paramètre dynamique {id} pour cibler le bon mariage et utilise le bon SupervisorController
        Route::get('/generate-borne-qr/{id}', [SupervisorController::class, 'generateBorneQr'])->name('supervisor.borne.qr');
    });

    // 4. LOGIQUE DE SUIVI TEMPS RÉEL (AJAX & Formulaires Globaux)
    Route::post('/guest/set-seated/{id}', [EventMasterController::class, 'setSeated'])->name('guest.set-seated');
    Route::post('/guest/set-served/{id}', [EventMasterController::class, 'setServed'])->name('guest.set-served');
    
    // 🔥 ROUTE DES BOISSONS ATTRIBUÉES SUR PLACE CORRIGÉE
    Route::post('/serveur/serve-drink/{id}', [EventMasterController::class, 'serveDrinkOnSite'])->name('serveur.serve-drink');
    
    // Vue Serveur & Staff d'accueil
    Route::get('/server/wedding/{id}/dashboard', [EventMasterController::class, 'serverDashboard'])->name('server.dashboard');

    // 5. PROFIL COMMUN
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// --- SOLUTION DE SECOURS ---
Route::get('/secure-redirect-dashboard', function () {
    return redirect()->route('client.dashboard');
})->name('wedding.client.space');