@extends('layout.default')

@section('content')
<div id="app">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Delivery Details</div>
                    <div class="card-body">
                        <datatable-component></datatable-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection