@extends('layout.default')

@section('content')
    <div class="container">
    <table class="table table-hover">
                  <thead>
                      <tr class="table-primary">
                          <td>Despatched Date</td>
                          <td>Delivered Date</td>
                          <td>From</td>
                          <td>To</td>
                          <td>Actual days</td>
                          <td>Average days</td>
                          <td>Estimated days</td>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($records as $deliveryrecord)
                      <tr>
                          <td>{{ $deliveryrecord->despatched }}</td>
                          <td>{{ $deliveryrecord->delivered }}</td>
                          <td>{{ $deliveryrecord->from_zone }}</td>
                          <td>{{ $deliveryrecord->to_zone }}</td>
                          <td>{{ $deliveryrecord->actualdays }}</td>
                          <td>{{ $deliveryrecord->avgdays }}</td>
                          <td>{{ $deliveryrecord->estimatedays }}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              {{ $records->links() }}
    </div>
@endsection