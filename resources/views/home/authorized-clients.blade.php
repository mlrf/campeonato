@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Tokens</h3>
                <passport-authorized-clients></passport-authorized-clients>
            </div>
        </div>
    </div>
@endsection
