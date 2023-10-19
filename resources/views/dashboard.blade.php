@extends('layout.layout')
@section('container')
    <div class="row">
        <div class="col-3">
          @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('shared.submit-idea')
            <hr>
            
            {{-- <div class="mt-3"> --}}
                @forelse($ideas as $idea)
                    <div class="mt-3">
                       @include('shared.idea-card')
                    </div>
                @empty
                    <p class="text-center my-3">No Result Found</p>
                @endforelse
            
            <div class="mt-3">
                {{$ideas->links()}}
            </div>
            {{-- </div> --}}
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-bar')
        </div>
    </div>
@endsection