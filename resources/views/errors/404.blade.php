@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : 404 Page
@endsection

@section('content')

    <div class="container">

        <div class="col-12 my-3">
            <div class="card">
                <div class="card-header row no-gutters">
                    <h1 class="ml-auto mr-auto">Αυτή η σελίδα δεν υπάρχει</h1>
                </div>

                <div class="card-body text-center">

                    <img src="/images/site/404.jpg" class="card-img">

                    <h5>Έχεις γράψει λάθος την διεύθυνση ή δεν υπάρχει πλέον η σελίδα</h5>

                    <h5>Μπορείς να επιστρέψεις στην <a href="{{ secure_url('/') }}" class="font-weight-bold">αρχική σελίδα</a></h5>

                </div>

            </div>

        </div>

    </div>


@endsection