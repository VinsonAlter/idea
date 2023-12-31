@extends('layout.layout')

@section('title', $user->name)

@section('container')
    <div class="row">
        <div class="col-3">
           @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            
            <div class="mt-3">
                <div class="mt-3">
                    @include('users.shared.user-card')
                </div>
            </div>
            <hr>
            @forelse($ideas as $idea)
            <div class="mt-3">
               @include('ideas.shared.idea-card')
            </div>
            @empty
                <p class="text-center my-3">No Result Found</p>
            @endforelse
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-bar')
        </div>
    </div>
@endsection