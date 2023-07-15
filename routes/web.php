<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// HTTP Methods
// GET    - read / Read
// POST   - store / Create
// PUT    - update / Update
// DELETE - delete / Delete


// all of these methods were defined in ListingController controller

// All listings (with controller)
Route::get('/', [ListingController::class, 'index']);                           // [class, methodname]

// Show create form (with auth middleware)
// Route authenticated users only
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');     // {listing} - Route model binding

// Edit submit to update
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');        

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');        

// Single listing (with controller)
Route::get('/listings/{listing}', [ListingController::class, 'show']);          // [class, methodName]


// Show register/create form (with guest middleware)
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create new user
Route::post('/users', [UserController::class, 'store']);

// Log user out 
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show login form
// name('login') is used to define Route login (names this Route)
// refering to route('login') in app/Http/Middleware/Authenticate.php
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log in user
Route::post('/user/authenticate', [UserController::class, 'authenticate']);     // you can refactor URI, this is just preference




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
