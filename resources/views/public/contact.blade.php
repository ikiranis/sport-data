@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Επικοινωνία
@endsection

@section('content')

    <div class="container">

        <div class="col-12 my-3">
            <div class="card">
                <div class="card-header">
                    <h1>Επικοινωνία</h1>
                </div>

                <div class="card-body">

                    <p>Στείλτε μας οτιδήποτε μπορεί να ενδιαφέρει το <strong>wmsports.gr</strong>, για δημοσίευση.
                        Ειδήσεις, δεδομένα, στατιστικά κοκ, αλλά και παρατηρήσεις για το site</p>

                    <p>e-mail: <strong>rocean74 (at) gmail.com</strong></p>

                </div>

            </div>

        </div>

    </div>


@endsection