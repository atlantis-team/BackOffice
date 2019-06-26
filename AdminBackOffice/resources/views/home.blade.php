@extends('layout.app')

@section('content')
    <div class="jumbotron bg-transparent m-0">
        <h1 class="display-4">Hello, admin!</h1>
            <p class="lead">You are on the administration platform of the Atlantis project.<br/>This platform aims to list the IoT devices associated with users of the mobile application.</p>
        <hr class="my-4">
        <p>You can now associate the devices with users by clicking on the button below.</p>
        <a class="btn btn-primary btn-lg" href="{{route('devices')}}" role="button">Associate devices</a>
    </div>
@endsection
