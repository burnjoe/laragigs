<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
    public function index() {
        // request()->tag and request('tag') is just the same thing
        // dd(request());

        // code from web.php
        return view('listings.index', [   
            // replace all() with latest ()            
            // 'listings' => Listing::all()

            // latest() sorts the row/data in descending order
            // tag, search are the names of get request tag is from clicked tags
            // and search is from search bar of the web app 
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()                
        ]);   
    }

    // show single listing
    public function show(Listing $listing) {
        // code from web.php
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // show create form
    public function create() {
        return view('listings.create');
    }

    // store listing data
    public function store(Request $request) {           // dependency injection
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // if validate() did not raise an error, create record
        // will produce fillable error the first time you run it
        Listing::create($formFields);

        // alternative of with()
        // Session::flash('message', 'Listing Created Successfully!');

        return redirect('/')->with('message', 'Listing Created Successfully!');
    }
}
