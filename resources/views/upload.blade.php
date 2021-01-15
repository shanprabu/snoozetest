@extends('layout.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="formsubmit">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <p>Uploaded files will be sent to a queue for processing.</p>
                    </div>
                </div>
                    <div class="form-group">
                        <label class="control-label col-md-6">Estimated Delivery Time file</label>
                        <div class="col-md-6">
                            <input type="file" name="etfile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-6">Realtime Delivery File</label>
                        <div class="col-md-6">
                            <input type="file" name="rtfile">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-lg btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection