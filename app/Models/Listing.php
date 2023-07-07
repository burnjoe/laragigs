<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // own defined methods of Listing model:

    // filter out table given the query
    public function scopeFilter($query, array $filters) {
        // please do refer from ListingController

        // if $filters['tag] == null it then evaluates to false, preventing any potential errors.
        if($filters['tag'] ?? false) {          // ?? null coalescing operator    
            // same as SELECT ... WHERE tags LIKE '%tag%'
            $query->where('tags', 'like', '%' . request('tag') . '%');       // like query
        }

        // if get request is search:
        if($filters['search'] ?? false) {          // ?? null coalescing operator    
            // same as SELECT ... WHERE tags LIKE '%search%'
            // the first argument is the fieldname or the column name of the table to be queried out
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')       // like query
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%');
        }
    }
}
