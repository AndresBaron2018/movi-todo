@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">App de vehicle</div>
                    <div class="card-body">
                        <vehicle-index :users="{{ $users }}" :vehicles="{{ $vehicles }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
