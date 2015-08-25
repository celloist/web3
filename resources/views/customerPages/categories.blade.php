@extends('layout.frontend')
@section('title', 'Categories')
@section('fcontent')
    <div class="row">
        <h1>Categories</h1>
        <div class="large-12 columns">
            <div class="row">
                <div class="large-8 columns">
                    <div class="row" data-equalizer>

                        @foreach ($categories as $category)
                            <div class="large-4 small-6 columns" id="{{$category->id}}" data-equalizer-watch>
                                <a href="{{url('categories/'.$category->id)}}">
                                    <img src="{{ relative_images_path() . '/' . $category->thumb }}">

                                    <div class="panel">
                                        <h5>{{ $category->name }}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection