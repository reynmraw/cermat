<?php 

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::post('/consume-api', [ApiController::class, 'login']);