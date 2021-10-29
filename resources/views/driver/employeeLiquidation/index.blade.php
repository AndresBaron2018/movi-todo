{{-- @php
    dd($users);
@endphp --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liquidación semanal</div>
                    <div class="card-body">
                        <employee-liquidation />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script href="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('/js/dataTables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables/jszip.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/js/dataTables/buttons.html5.min.js') }}"></script>
@endsection
