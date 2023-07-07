{{-- since we're using a blade template by appending '.blade' 
after the name, we can shorten php tag for echoing a data by 
use of curly braces: --}}

{{-- inherits the layout from resources/views (essential for @section) --}}
{{-- @extends('layout')                   --}}

{{-- sends data to @yield() section --}}
{{-- @section('content')                  --}}

<x-layout>

@include('partials._hero')          {{-- includes the hero section in listings page --}}
@include('partials._search')        {{-- includes the search section in listings page --}}

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

{{-- for loops, conditionals, etc., we can use directives 
by using '@' and omitting php tags: --}}

@if(count($listings) == 0)          {{-- @unless() alternative to @if() --}}
  <p>No listings found</p>
@else

@foreach($listings as $listing)

<x-listing-card :listing="$listing" />

@endforeach
@endif

</div>

</x-layout>
{{-- ends the section 'content' --}}
{{-- @endsection                          --}}