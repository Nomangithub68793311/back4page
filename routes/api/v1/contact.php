






<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;






Route::post('/add/contact', [ContactController::class,'store'])->middleware('IpCheckAndAllow');
Route::get('/get/contact', [ContactController::class,'getContact'])->middleware('IpCheckAndAllow');






// php artisan make:model Contact -mcr 







