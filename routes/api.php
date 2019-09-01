<?php

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Auth;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('events', function(){
    return Event::all();
});

Route::get('events/{id}', function($id){
    return Event::find($id);
});

Route::post('events', function(Request $request) {
    return Event::create(json_decode($request->getContent(), true));
});

Route::put('events/{id}', function(Request $request, $id) {
    $event = Event::findOrFail($id);
    $event->update(json_decode($request->getContent(), true));
    return $event;
});

Route::delete('events/{id}', function($id) {
    Event::find($id)->delete();
    return 204;
});
