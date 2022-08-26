@extends('layouts.app')

@section('content')
<div class="container">
    <img id="fondo_home" src="{{ asset('/img/Fondo.jpg')}} " width="1275px" height="600px"  />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
