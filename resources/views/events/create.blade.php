@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create New Event</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('events.store') }}">
                        <div class="form-group">
                            <label for="eventName">Event Name</label>
                            <input type="text" name="eventName" class="form-control" id="eventName" placeholder="Enter event name">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#slug').change(function() {

            var slug = $(this).val();
            str = slug.replace(/\s+/g, '-').toLowerCase();
            console.log(str);
            $('#slug').val(str);
        });
    });
</script>