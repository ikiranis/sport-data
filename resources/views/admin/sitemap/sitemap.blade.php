@extends('layouts.admin')

@section('content')
    <h1>Sitemap</h1>

    <a href="{{route('createSitemap')}}">
        <button type="submit" class="btn btn-danger">
            Create Sitemap
        </button>
    </a>

@endsection
