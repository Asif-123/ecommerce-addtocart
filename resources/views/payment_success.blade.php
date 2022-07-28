@extends('layouts.app')

@section('content')
<style>
    .box {
        box-shadow: 0 .125rem 1.25rem rgba(0, 0, 0, .075) !important;
    }
    #total_amount{
    display: inline-flex;
}

    input#number {
        width: 30px;
        height: 30px;
        text-align: center;
    }
</style>

<body>
    <div class="container box">
        <div class="row">
            <div class="heading">
                <h4>Order Detailes</h4>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Receipt Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">phone</th>
                        <th scope="col">Order Status</th>
                    </tr>
                </thead>
                <tbody>                
                    <tr>
                        <td scope="row">{{$response['order']['order_id']}}</td>
                        <td scope="row">{{$response['order']['receipt_id']}}</td>
                        <td scope="row">{{$response['order']['amount']/100}}</td>
                        <td scope="row">{{$response['order']['customer']['name']}}</td>
                        <td scope="row">{{$response['order']['customer']['email']}}</td>
                        <td scope="row">{{$response['order']['customer']['phone']}}</td>
                        <td scope="row">{{$response['order']['order_status']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
@endsection