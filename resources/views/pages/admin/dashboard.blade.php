@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">

        <div class="row justify-content-center mb-4">
            <div class="col-md-10">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>{{ session('danger') }}</strong>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>




        <div class="row justify-content-center">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-kalografi">All Packages</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="bookingTable" aria-describedby="bookingTable"
                                style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Packages</th>
                                        <th scope="col">Book Date</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Address</th>
                                        <th scope="col" class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking as $booking)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $booking->full_name }}</td>

                                            @if ($booking->package_id == null)
                                                <td>Custom Package</td>
                                            @else
                                                <td>{{ $booking->package->name }} {{ $booking->package->category }}</td>
                                            @endif

                                            <td>{{ $booking->book_date }}</td>
                                            <td>{{ $booking->order_id }}</td>
                                            <td>{{ $booking->email }}</td>
                                            <td>{{ $booking->phone_number }}</td>
                                            <td>{{ 'Rp' . number_format($booking->total_price) }}</td>
                                            <td>{{ $booking->address }}</td>
                                            <td>
                                                <form action="{{ route('admin.search-result') }}" method="GET">
                                                    <input type="hidden" name="order_id"
                                                        class="form-control form-control-sm text-center"
                                                        value="{{ $booking->order_id }}">
                                                    <button type="submit" class="btn btn-kalografi btn-block">
                                                        Detail
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>


                        </div>

                        @endforeach

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#bookingTable').DataTable();
        });
    </script>
@endsection
