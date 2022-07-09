<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RobotController;
use App\Http\Controllers\RobotmodelController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\InputsensorController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Public Routes

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/allusers', [AuthController::class, 'allusers']);

//Protected Routes
//Route::group(['middleware'=>['auth:sanctum']], function(){


    Route::get('/robotmodels', [RobotmodelController::class, 'index']);
    Route::get('/robotmodels/{id}', [RobotmodelController::class, 'show']);
    Route::get('/robotmodels/search/{name}', [RobotmodelController::class, 'search']);

    Route::get('/robots', [RobotController::class, 'index']);
    Route::get('/robots/{id}', [RobotController::class, 'show']);
    Route::get('/robots/search/{name}', [RobotController::class, 'search']);

    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/countries/{id}', [CountryController::class, 'show']);
    Route::get('/countries/search/{name}', [CountryController::class, 'search']);

    Route::get('/states', [StateController::class, 'index']);
    Route::get('/statesncountries', [StateController::class, 'indexcountries']);
    Route::get('/states/{id}', [StateController::class, 'show']);
    Route::get('/states/search/{name}', [StateController::class, 'search']);

    Route::get('/cities', [CityController::class, 'index']);
    Route::get('/citiesnstatesncountries', [CityController::class, 'indexstatescountries']);
    Route::get('/cities/{id}', [CityController::class, 'show']);
    Route::get('/cities/search/{name}', [CityController::class, 'search']);

    Route::get('/parameters', [ParameterController::class, 'index']);
    Route::get('/parameters/{id}', [ParameterController::class, 'show']);
    Route::get('/parameters/search/{name}', [ParameterController::class, 'search']);

    Route::get('/inputsensors', [InputsensorController::class, 'index']);
    Route::get('/inputsensors/{id}', [InputsensorController::class, 'show']);
    Route::get('/inputsensors/search/{name}', [InputsensorController::class, 'search']);

    //Public Counts
    Route::get('/robots/countofrobots/{id}', [RobotController::class, 'countofrobots']);


    //Get Info for a user
    Route::get('/robots/infoofallrobots/{id}', [RobotController::class, 'infoofallrobots']);


    Route::post('/robotmodels', [RobotmodelController::class, 'store']);
    Route::post('/robotmodels/{id}', [RobotmodelController::class, 'update']);
    Route::delete('/robotmodels/{id}', [RobotmodelController::class, 'destroy']);
    
    Route::post('/robots', [RobotController::class, 'store']);
    Route::post('/robots/{id}', [RobotController::class, 'update']);
    Route::delete('/robots/{id}', [RobotController::class, 'destroy']);
    
    Route::post('/countries', [CountryController::class, 'store']);
    Route::post('/countries/{id}', [CountryController::class, 'update']);
    Route::delete('/countries/{id}', [CountryController::class, 'destroy']);
    
    Route::post('/states', [StateController::class, 'store']);
    Route::post('/states/{id}', [StateController::class, 'update']);
    Route::delete('/states/{id}', [StateController::class, 'destroy']);
    
    Route::post('/cities', [CityController::class, 'store']);
    Route::post('/cities/{id}', [CityController::class, 'update']);
    Route::delete('/cities/{id}', [CityController::class, 'destroy']);
    
    Route::post('/parameters', [ParameterController::class, 'store']);
    Route::post('/parameters/{id}', [ParameterController::class, 'update']);
    Route::delete('/parameters/{id}', [ParameterController::class, 'destroy']);
    
    Route::post('/inputsensors', [InputsensorController::class, 'store']);
    Route::put('/inputsensors/{id}', [InputsensorController::class, 'update']);
    Route::delete('/inputsensors/{id}', [InputsensorController::class, 'destroy']);
    
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/getuser/{id}', [AuthController::class, 'getuser']);
    Route::delete('/deluser/{id}', [AuthController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
        
//});
