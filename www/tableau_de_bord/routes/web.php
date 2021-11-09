<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanteController;
use App\Http\Controllers\editerPlantesController;
use App\Http\Controllers\generationExcelController;
use App\Http\Controllers\editerFichiersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('template');
});
Route::resource('generationExcel', generationExcelController::class);
Route::resource('ajouterPlante', PlanteController::class);
Route::resource('editerPlante', editerPlantesController::class);
Route::resource('editerFichiers', editerFichiersController::class);
