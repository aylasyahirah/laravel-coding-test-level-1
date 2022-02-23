@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List of Events</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div>
                        <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($events as $index => $event)
                            <tr>
                                <td>{{ $events->firstItem() + $index }}</td>
                                <td><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></td>
                                <td>{{ $event->slug }}</td>
                                <td>{{ $event->start_at }}</td>
                                <td>{{ $event->end_at }}</td>
                                <td>-</td>
                                <td>
                                    <button type="button" class="btn btn-info">Update</button>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection