@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('content')

    <div class="card">
        <div class="col-12">
            <h3><b>New Order List</b>
                <a href="{{ 'order-history' }}" class="btn btn-primary float-right">View Order History</a>
            </h3>
            @php
                $total = 0;
                $count = 0;
            @endphp
        </div>
        <hr>
        <div class="card-body">
            <table class="table table-boradered table-striped">
                <thead>
                    <tr>
                        <th> <b>No. </b></th>
                        <th>
                            <b>
                                <center>Order Date</center>
                            </b>
                        </th>
                        <th>
                            <b>
                                <center>Customer Name</center>
                            </b>
                        </th>
                        <th>
                            <b>
                                <center>Total Price</center>
                            </b>
                        </th>
                        <th>
                            <b>
                                <center>Status</center>
                            </b>
                        </th>
                        <th>
                            <b>
                                <center>Action</center>
                            </b>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)

                        @php
                            $myvalue = $item->created_at;
                            
                            $datetime = new DateTime($myvalue);
                            $date = $datetime->format('d-m-Y');
                            $time = $datetime->format('H:i:s');
                            
                        @endphp
                        <tr>
                            <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}.</td>
                            <td>
                                <center>{{ $date }}</center>
                            </td>
                            <td>
                                <center>{{ $item->fname }} {{ $item->lname }} </center>
                            </td>
                            <td>
                                <center>RM {{ $item->total_price }} </center>
                            </td>
                            <td>
                                <center>{{ $item->status == '0' ? 'Pending' : 'Completed' }} </center>
                            </td>
                            <td>
                                <center>
                                    <a href="{{ url('admin/view-order/' . $item->id) }}" class="btn btn-primary">View</a>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="mx-auto mt-3">
                    {!! $orders->links() !!}
                </div>
            </div>

        </div>
    </div>


@endsection