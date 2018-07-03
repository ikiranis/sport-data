@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Αποστολή είδησης
@endsection

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Αποστολή είδησης</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('storePost') }}">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="title">{{__('messages.title')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.title')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">{{__('messages.text')}}</label>
                                <textarea class="form-control" id="body" name="body" rows="10">{{old('body')}}</textarea>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="author">Όνομα</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Όνομα</span>
                                </div>
                                <input type="text" max="25" class="form-control col-10 px-2" id="author"
                                       name="author"
                                       value="{{old('author')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.reference')}}</span>
                                </div>
                                <input type="text" max="800" class="form-control col-10 px-2" id="reference"
                                       name="reference"
                                       value="{{old('reference')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" v-model="sportSelected" id="sport_id"
                                        name="sport_id">
                                    <option value="0"></option>
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}">
                                            {{$sport->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    Αποστολή
                                </button>
                            </div>

                        </form>

                        <p>Στείλτε μια είδηση για δημοσίευση. Η δημοσίευση δεν θα γίνεται άμεσα, αλλά <strong>μετά από έλεγχο</strong>.
                        Το κείμενο θα καταχωρείται. Μέσα στις επόμενες ώρες, θα γίνεται η επεξεργασία της μορφοποίησης, θα μπαίνει σχετική φωτογραφία και ότι άλλο χρειαστεί
                        και στη συνέχεια θα δημοσιεύεται.</p>

                        <p>Μπορείτε να στείλετε είτε πρωτότυπα κείμενα, είτε αναδημοσιεύσεις. Φυσικά <strong>πάντα πρέπει
                                να γράφετε και το link για την πηγή</strong>, όταν υπάρχει. Στις αναδημοσιεύσεις πιθανό είναι να
                        μπει μόνο ένα απόσπασμα ή μία περίληψη.</p>

                        <p>Προαιρετικά μπορείτε να γράψετε και κάποιο όνομα, το οποίο θα εμφανίζεται στο
                        σχετικό post.</p>

                        <p>Δημοσιεύονται <strong>μόνο κείμενα αθλητικού περιεχομένου</strong>, που αφορούν κυρίως τον ερασιτεχνικό
                        αθλητισμό στη Δυτική Μακεδονία. Χωρίς να υπάρχει όμως αυστηρός περιορισμός, αν υπάρχει και
                            κάτι γενικότερα ενδιαφέρον αθλητικά.</p>

                        <p>Δεν δημοσιεύονται κείμενα προσβλητικού περιεχομένου ή συκοφαντικά. Όπως
                        επίσης δεν πρέπει να είναι ψευδή δημοσιεύματα, στον βαθμό που μπορούμε κι εμείς
                        να τα ελέγξουμε.</p>

                        <p>Κείμενα μπορείτε να στείλετε (αν δεν σας καλύπτει αυτή η φόρμα) και με τις υπόλοιπες μεθόδους επικοινωνίας, που εμφανίζονται
                            στην <a href="{{ route('contact') }}"><strong>σχετική σελίδα</strong></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection