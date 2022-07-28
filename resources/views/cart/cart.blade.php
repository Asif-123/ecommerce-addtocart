@extends('layouts.app')

@section('content')
<style>
    .box {
        box-shadow: 0 .125rem 1.25rem rgba(0, 0, 0, .075) !important;
    }

    #total_amount {
        display: inline-flex;
    }

    input#number {
        width: 30px;
        height: 30px;
        text-align: center;
    }

</style>

<div class="container box">
    <div class="row">
        <div class="heading">
            <h4>Cart List</h4>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $amtArr = [];
                if (!count($cart) == 0) {

                    foreach ($cart as $val) {

                        array_push($amtArr, $val->total_amount);
                ?>
                        <tr>
                            <th scope="row">{{$val->id}}</th>
                            <th scope="row">{{$val->product_id}}</th>
                            <td scope="row"><img src="{{$val->image}}" alt="" height="50px" width="50px"></td>
                            <td>{{$val->product_name}}</td>
                            <td scope="row form">
                                <input type="button" onclick="decrementValue('{{$val->id}}', '{{$val->product_id}}')" value="-" />
                                <input type="text" name="quantity" value="{{$val->quantity}}" maxlength="2" max="10" size="1" id="num_{{$val->id}}" readonly />
                                <input type="button" onclick="incrementValue('{{$val->id}}', '{{$val->product_id}}')" value="+" />
                            </td>
                            <td id="qty-amt{{$val->product_id}}">{{$val->total_amount}}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="{{$val->id}}" onclick="deleteCart(this)">Delete</a>
                            </td>
                        </tr>

                    <?php }
                    $total_amount = array_sum($amtArr);
                } else { ?>
                    <!-- <h4 class="cart">Cart not available </h4> -->
                <?php } ?>
            </tbody>
        </table>
        <?php
        if (!count($amtArr) == 0) { ?>
            <div>
                <form action="{{ url ('/payment')}}" method="post">
                    @csrf
                    <!-- <input type="hidden" name="txnid" value="<?php //$txnid ?>" /> -->
                    <input type="hidden" name="amount" value="{{$total_amount}}" id="total_amt"/>
                    <input type="hidden" name="name" id="name" value="testing" />
                    <input type="hidden" name="email" id="email" value="testing@gmail.com" />
                    <input type="hidden" name="phone" value="9999999999">
                    <input type="hidden" name="productinfo" value="{{$val->product_name}}">
                    <input type="submit" class="btn btn-success btn-sm" value="Buy Now" style="float:right; margin: 0 50px;">
                    <strong style="float:right;">Total amount : Rs. <p id="total_amount">{{$total_amount}}</p>/-</strong>
                </form>
            </div>
        <?php } ?>
    </div>

</div>


<script>
    function deleteCart(item) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var proId = $(item).data('id');
        $.ajax({
            type: "POST",
            url: "{{url('/delete-cart-product')}}",
            data: {
                'proId': proId,
            },
            success: function(response) {
                console.log(response.status);
                window.location.reload();

            },
            error: function(response){
                console.log(response.status);
            }
        });
    }

    function incrementValue(id, proId) {
        var value = parseInt(document.getElementById('num_' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            document.getElementById('num_' + id).value = value;
        }

        $.ajax({
            type: "POST",
            url: "{{url('/cart-quantity')}}",
            data: {
                'qty': value,
                'proID': proId
            },
            success: function(response) {
                $('#qty-amt').html('');
                $('#qty-amt' + proId).html(response.data['sum']);
                $('#total_amount').html(response.data['total_amount']);
                $('#total_cart_count').html(response.data['cart_count']);
                $('#total_amt').val(response.data['total_amount']);
                console.log(response.data['sum']);
            }
        });
        //location.reload(true);
    }

    function decrementValue(id, proId) {
        var value = parseInt(document.getElementById('num_' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            document.getElementById('num_' + id).value = value;
        }

        $.ajax({
            type: "POST",
            url: "{{url('/cart-quantity-decreament')}}",
            data: {
                'qty': value,
                'proID': proId
            },
            success: function(response) {
                $('#qty-amt').html('');
                $('#qty-amt' + proId).html(response.data['sum']);
                $('#total_amount').html(response.data['total_amount']);
                $('#total_cart_count').html(response.data['cart_count']);
                $('#total_amt').val(response.data['total_amount']);
                console.log(response.data['sum']);
            }
        });

    }
</script>

@endsection