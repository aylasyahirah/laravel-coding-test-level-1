@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create New Event</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="eventName">Event Name</label>
                            <input type="text" name="eventName" class="form-control" id="eventName" placeholder="Enter event name">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug">
                        </div>
                        <div class="form-group">
                            <label for="startAt">Start At</label>

                            <div class='input-group date' id='startAt'>
                                <input type='text' class="form-control" name="startAt" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endAt">End At</label>

                            <div class='input-group date' id='endAt'>
                                <input type='text' class="form-control" name="endAt" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#slug').change(function() {

            var slug = $(this).val();
            str = slug.replace(/\s+/g, '-').toLowerCase();
            console.log(str);
            $('#slug').val(str);
        });

        $('#startAt').datetimepicker({
            format: 'DD/MM/YYYY hh:mm A'
        });
        $('#endAt').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            format: 'DD/MM/YYYY hh:mm A'
        });
        $("#startAt").on("dp.change", function(e) {
            $('#endAt').data("DateTimePicker").minDate(e.date);
        });
        $("#endAt").on("dp.change", function(e) {
            $('#startAt').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
@endsection