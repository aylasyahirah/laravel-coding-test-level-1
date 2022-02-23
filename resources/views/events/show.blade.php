@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Event Details</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Event Name :</th>
                                <td>{{ $event->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Slug :</th>
                                <td>{{ $event->slug }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Start At :</th>
                                <td>{{ $event->start_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">End At :</th>
                                <td>{{ $event->end_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection