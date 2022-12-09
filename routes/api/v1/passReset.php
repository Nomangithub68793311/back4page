
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordReset;

Route::post('/password/reset/email', [PasswordReset::class,'passReset']);

Route::post('/password/change/email', [PasswordReset::class,'passChange']);






 