@extends('layout.layout')

@section('container')
    <div class="row">
        <div class="col-3">
           @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            <hr>
            <div class="mt-3">
                <div class="mt-3">
                    @include('shared.idea-card')
                </div>
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-bar')
        </div>
    </div>
@endsection