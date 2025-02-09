<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

//landing page
Route::get('/', [ClientController::class, 'welcome'])->name('welcome');

// CLIENT
    Route::get('/auth/login', [AuthController::class, 'authLogin'])->name('auth.login');
    Route::get('/show/services/{service}', [ClientController::class, 'clientServiceBooking'])->name('client.servicebooking');

    Route::middleware(['client'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'clientDashboard'])->name('client.dashboard');
    Route::get('/client/profile', [ClientController::class, 'clientProfile'])->name('client.profile');  
    Route::get('/client/categories', [ClientController::class, 'clientCategories'])->name('client.categories');
    Route::get('/client/services', [ClientController::class, 'clientServices'])->name('client.services');  

// booking transaction
    Route::get('/client/booking', [ClientController::class, 'clientBooking'])->name('client.booking');
    Route::get('/client/ongoing', [ClientController::class, 'ongoing'])->name('client.ongoing');
    Route::get('/client/completed',[ClientController::class, 'completed'])->name('client.completed');
    Route::post('/book-completed/bookings/{booking}', [ClientController::class, 'completedBooking'])->name('client.completedBooking');
    Route::get('/client/declined',[ClientController::class, 'declined'])->name('client.declined');

    Route::get('/client/confirmBook/services/{service}', [ClientController::class, 'confirmBook'])->name('client.confirmBook');
    Route::post('/book-service/services/{service}', [ClientController::class, 'bookService'])->name('client.bookService');
    Route::delete('/bookings/{booking}', [ClientController::class, 'cancelBooking'])->name('delete.booking');

    });

// PROVIDER
Route::middleware(['provider'])->group(function () {
    Route::get('/provider/dashboard', [ProviderController::class, 'providerDashboard'])->name('provider.dashboard');
    Route::get('/provider/profile', [ProviderController::class, 'providerProfile'])->name('provider.profile');

    Route::get('/provider/service', [ProviderController::class, 'providerService'])->name('provider.service');
    Route::post('saveService', [ProviderController::class, 'saveService'])->name('save.service');
    Route::post('/services/{service}', [ProviderController::class, 'updateService'])->name('update.service');
    Route::delete('/services/{service}', [ProviderController::class, 'deleteService'])->name('delete.service');


// booking transaction
    Route::get('/provider/booking', [ProviderController::class, 'pbooking'])->name('provider.booking');
    Route::get('/provider/ongoing', [ProviderController::class, 'pongoing'])->name('provider.ongoing');
    Route::get('/provider/completed', [ProviderController::class, 'pcompleted'])->name('provider.completed');
    Route::get('/provider/declined', [ProviderController::class, 'pdeclined'])->name('provider.declined'); 

    Route::patch('/provider/accept/{booking}', [ProviderController::class, 'acceptBooking'])->name('provider.accept');
    Route::patch('/provider/decline/{booking}', [ProviderController::class, 'declineBooking'])->name('provider.decline');

    Route::get('/provider/proceed/{booking}', [ProviderController::class, 'proceedBooking'])->name('provider.proceed');
    Route::get('/provider/cancel/{booking}', [ProviderController::class, 'cancelBooking'])->name('provider.cancel');

    Route::post('/provider-completed/bookings/{booking}', [ProviderController::class, 'providerCompletedBooking'])->name('provider.completedBooking');
    Route::get('/provider/reports', [ProviderController::class, 'reports'])->name('provider.reports');


});

// ADMIN
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');

    Route::get('/admin/home', [AdminController::class, 'index'])->name('Home');
    Route::get('/admin/bookings', [AdminController::class, 'booking'])->name('admin.bookings');

    Route::get('/admin/servicecategories', [AdminController::class, 'services'])->name('admin.servicecategories');
    Route::post('saveCategory', [AdminController::class, 'saveCategory'])->name('save.categories');
    Route::post('/categories/{category}', [AdminController::class, 'updateCategory'])->name('update.categories');
    Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('delete.category');

    Route::get('/admin/addcategories', [AdminController::class, 'addCategories'])->name('AddCategories');
    Route::get('/admin/editcategories', [AdminController::class, 'editCategories'])->name('EditCategories');


    Route::get('/admin/serviceprovider', [AdminController::class, 'serviceProvider'])->name('admin.serviceprovider');
    Route::post('saveProvider', [AdminController::class, 'saveProvider'])->name('save.provider');
    Route::patch('/admin/service-providers/users/{user}', [AdminController::class, 'updateProvider'])->name('update.provider');
    Route::delete('/admin/service-providers/users/{user}', [AdminController::class, 'deleteProvider'])->name('delete.provider');


    Route::get('/admin/usermanagement', [AdminController::class, 'userManagement'])->name('admin.user');
    Route::post('saveClient', [AdminController::class, 'saveClient'])->name('save.client');
    Route::patch('/users/{user}', [AdminController::class, 'updateClient'])->name('update.client');
    Route::delete('/users/{user}', [AdminController::class, 'deleteClient'])->name('delete.client');
    Route::get('/admin/deletebooking/{id}', [AdminController::class, 'deleteBooking'])->name('admin.deletebooking');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
