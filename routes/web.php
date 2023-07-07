<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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


// Common Resource Routes:
// index  - show all listings
// show   - show single listing
// create - show form to create new listing (show form for input)
// store  - store new listing (submit form with inputs)
// edit   - show form to edit listing (show form for modifying input)
// update - update listing (submit for with changes to inputs)
// destroy- delete listing (delete)


// all of these methods were defined in ListingController controller

// All listings (with controller)
Route::get('/', [ListingController::class, 'index']);                           // [class, methodname]

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

// Store listing data
Route::post('/listings', [ListingController::class, 'store']);

// Single listing (with controller)
Route::get('/listings/{listing}', [ListingController::class, 'show']);          // [class, methodName]




// Replaced
// All listings (without controller)
// Route::get('/', function() {
    // return view('listings', [               // entry point ('/' means root)
    //     'listings' => Listing::all()
    // ]);        
// });


// Single listing 
// Route::get('/listings/{id}', function($id) {
//     $listing = Listing::find($id);          // eloquent (ORM): transform table into class - this returns the row with given id

//     if ($listing) {
//         return view('listing', [
//             'listing' => $listing
//         ]);
//     } else {
//         abort('404');                       // calls the page showing that page is not found
//     }
// });


// Single listing (Route Model Binding) (without controller)
// does the same thing as commented function called above
// Route::get('/listings/{listing}', function(Listing $listing) {          // Listing is an ORM from app/Models
    // return view('listing', [
    //     'listing' => $listing
    // ]);
// });





// references

// routing and responses 
Route::get('/hello', function() {
    return response('<h1>Hello, World!</h1>');
});

// wildcard endpoints
Route::get('/posts/{id}', function($id) {       // sample request: /posts/11
    // dd($id);
    // ddd($id);
    return response('Post:' . $id);
})->where('id', '[0-9]+');                      // route contraints where(wildcard/param, regex) eg. '[0-9]+' chars between 0-9 only

// request and query params
Route::get('/search', function(Request $request) {           // sample request: /search?id=1&name=Joe
    return $request->id . " " . $request->name;
});