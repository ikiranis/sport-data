<div class="container my-3">
    <form method="GET" action="{{ route('search') }}">

        <div class="input-group mb-3 no-gutters col-lg-6 col-12 ml-auto mr-auto">
            <label class="sr-only" for="search">Αναζήτηση</label>
            <input type="text" max="255" class="form-control col-10 px-2" id="search" name="search">
            <button class="btn btn-success col-2">Αναζήτηση</button>
        </div>

        @csrf
    </form>
</div>