@extends('user::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
        @livewire('user::cart')
        @livewire('user::products')

    </div>
</div>
@endsection
