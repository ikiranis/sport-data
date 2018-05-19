@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : About
@endsection

@section('content')

    <div class="container">

        <div class="col-12 my-3">
            <div class="card">
                <div class="card-header">
                    <h1>About</h1>
                </div>

                <div class="card-body">

                    <p>Το <strong>WM Sports (West Macedonia Sports)</strong> είναι ένα site για τον ερασιτεχνικό
                        αθλητισμό στη <strong>Δυτική Μακεδονία</strong> (και όχι μόνο). Περιέχει σχετική ειδησεογραφία,
                        μαζί με αποτελέσματα, βαθμολογίες (υπολογίζονται αυτόματα), στατιστικά κτλ. </p>

                    <p>Η ειδησεογραφία θα προέρχεται κυρίως από δημοσιεύματα άλλων ειδησεογραφικών sites, ή απευθείας
                        από ομοσπονδίες, ομάδες κτλ. Με κάποια ίσως επεξεργασία. Πάντα θα περιέχεται link προς την πηγή.
                        Θέλουμε το <strong>wmsports.gr</strong> να είναι περισσότερο κάτι σαν
                        <strong>aggregator</strong>.</p>

                    <p>Όλα τα δεδομένα καταχωρούνται και εμφανίζονται δυναμικά. Κάνουμε προσπάθεια να υπάρχει όσο
                        γίνεται μεγαλύτερος συσχετισμός μεταξύ τους και άρα να υπάρχουν σύνδεσμοι από και προς όλες τις
                        μορφές δεδομένων</p>

                    <p>Προς το παρόν είναι σε δοκιμαστική λειτουργία και αναπτύσσεται συνεχώς</p>

                    <p>Το project είναι μια δημιουργία της <strong><a href="http://apps4net.eu">apps4net</a></strong></p>

                </div>

            </div>

        </div>

    </div>


@endsection