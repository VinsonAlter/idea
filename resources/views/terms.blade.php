@extends('layout.layout')

@section('title', 'Terms')

@section('container')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iusto praesentium possimus ipsam a aperiam magnam  odio, provident quas laudantium atque, nisi cum aliquid iste ea id ab amet voluptatem, est temporibus suscipit. At, adipisci id? Placeat sunt ut repudiandae natus fugit explicabo. Voluptatum aperiam possimus, recusandae dolorum quibusdam nam.</div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-bar')
        </div>
    </div>
@endsection
    