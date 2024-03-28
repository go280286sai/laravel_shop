<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use go280286sai\search_json\Http\Controllers\SearchJsonController;
use Illuminate\Support\Facades\Route;

Route::post('/search', [SearchJsonController::class, 'index']);
