<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factories\Factory;


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
    return view('welcome');
});

Route::get('/openpspdf', function () {
    return view('pspdf_document');
});

Route::get('/getpdf', function(){
    return User::orderBy('updated_at', 'DESC')->first()->toArray()['pdf'];
});

Route::get('/getjson', function(){
    return User::orderBy('updated_at', 'DESC')->first()->toArray()['instant_json'];
});

Route::post('/save', function(Request $request){
    $path = $request->file('blob')->getRealPath();
    $logo = file_get_contents($path);

    User::factory()->create([
        'pdf' => $logo,
    ]);
});

Route::post('/annotations', function(Request $request){
    dd($request->all());
    User::factory()->create([
        'instant_json' => json_encode($request->input()),
    ]);
});
