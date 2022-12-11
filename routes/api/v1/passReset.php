
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordReset;

Route::post('/password/reset/email', [PasswordReset::class,'passReset']);
Route::post('/password/code/match', [PasswordReset::class,'codeMatch']);
Route::post('/password/resend/email', [PasswordReset::class,'resendCode']);

Route::post('/password/change/email', [PasswordReset::class,'passChange']);



// https://back4page.xyz/password/reset/email

// https://back4page.xyz/password/change/email



 