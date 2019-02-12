
@if (count($errors) > 0)
    <div   id="alert_message" class=" alert alert-warning ">

        @foreach ($errors->all() as $error)
             {{ $error }}<br/>
        @endforeach

    </div>
@endif

@if ($message = Session::get('success'))

    <div  id="alert_message" class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div  id="alert_message" class="alert alert-warning alert-block">
        <strong>{{ $message }}</strong>
    </div>
@endif