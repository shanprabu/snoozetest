@extends('layout.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="formsubmit">
                {{ csrf_field() }}
                    <div class="control-group">
                        <label class="control-label">Carrier Provided Delivery Time file</label>
                        <div class="controls">
                            <input type="file" name="etfile">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Realtime Delivery File</label>
                        <div class="controls">
                            <input type="file" name="rtfile">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-lg btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection