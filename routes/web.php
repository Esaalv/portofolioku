<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/skills', [HomeController::class, 'skills'])->name('skills');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/{id}', [HomeController::class, 'projectDetail'])->name('projects.detail');
Route::get('/certificates', [HomeController::class, 'certificates'])->name('certificates');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/myportofolio-esa', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/myportofolio-esa', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Middleware: is_admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['is_admin'])->prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('admin.profile.index');
        Route::get('/profile/create', 'create')->name('admin.profile.create');
        Route::post('/profile', 'store')->name('admin.profile.store');
        Route::get('/profile/edit', 'edit')->name('admin.profile.edit');
        Route::put('/profile', 'update')->name('admin.profile.update');
    });

    // Skills
    Route::controller(SkillController::class)->group(function () {
        Route::get('/skills', 'index')->name('admin.skills.index');
        Route::get('/skills/create', 'create')->name('admin.skills.create');
        Route::post('/skills', 'store')->name('admin.skills.store');
        Route::get('/skills/{id}/edit', 'edit')->name('admin.skills.edit');
        Route::put('/skills/{id}', 'update')->name('admin.skills.update');
        Route::delete('/skills/{id}', 'destroy')->name('admin.skills.destroy');
    });

    // Projects
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects', 'index')->name('admin.projects.index');
        Route::get('/projects/create', 'create')->name('admin.projects.create');
        Route::post('/projects', 'store')->name('admin.projects.store');
        Route::get('/projects/{id}/edit', 'edit')->name('admin.projects.edit');
        Route::put('/projects/{id}', 'update')->name('admin.projects.update');
        Route::delete('/projects/{id}', 'destroy')->name('admin.projects.destroy');
        Route::patch('/projects/{id}/restore', 'restore')->name('admin.projects.restore');
        Route::get('/projects/trash', 'trash')->name('admin.projects.trash');
    });

    // Certificates
    Route::controller(CertificateController::class)->group(function () {
        Route::get('/certificates', 'index')->name('admin.certificates.index');
        Route::get('/certificates/create', 'create')->name('admin.certificates.create');
        Route::post('/certificates', 'store')->name('admin.certificates.store');
        Route::get('/certificates/{id}/edit', 'edit')->name('admin.certificates.edit');
        Route::put('/certificates/{id}', 'update')->name('admin.certificates.update');
        Route::delete('/certificates/{id}', 'destroy')->name('admin.certificates.destroy');
        Route::patch('/certificates/{id}/restore', 'restore')->name('admin.certificates.restore');
        Route::get('/certificates/trash', 'trash')->name('admin.certificates.trash');
    });

    // Messages
    Route::controller(MessageController::class)->group(function () {
        Route::get('/messages', 'index')->name('admin.messages.index');
        Route::get('/messages/{id}', 'show')->name('admin.messages.show');
        Route::delete('/messages/{id}', 'destroy')->name('admin.messages.destroy');
        Route::patch('/messages/{id}/read', 'markRead')->name('admin.messages.read');
    });
});
