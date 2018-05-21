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

                <div class="card-body article">

                    <p>Στείλτε μας οτιδήποτε μπορεί να ενδιαφέρει το <strong>wmsports.gr</strong>, για δημοσίευση.
                        Ειδήσεις, δεδομένα, στατιστικά κοκ, αλλά και παρατηρήσεις για το site</p>

                    <p>e-mail: <strong><a href="mailto:west.macedonia.sports@gmail.com">west.macedonia.sports@gmail.com</a></strong></p>

                    <p>Twitter account: <strong><a href="https://twitter.com/wmsports1">twitter.com/wmsports1</a></strong></p>

                    <p>Facebook page: <strong><a href="https://facebook.com/west.macedonia.sports">facebook.com/west.macedonia.sports</a></strong></p>

                </div>

            </div>

        </div>

    </div>


@endsection