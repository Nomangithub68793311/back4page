
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewAddAndGet;

Route::post('/view/add/{id}', [ViewAddAndGet::class,'AddView'])->middleware('IpCheckAndAllow');
Route::get('/view/get', [ViewAddAndGet::class,'GetView'])->middleware('IpCheckAndAllow');



