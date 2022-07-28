@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <title>E-commerce</title> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Styles -->
    <style>
        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar {
            width: 250px;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 999;
            color: #fff;
            transition: all 0.3s;
            margin-top: -25px;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        .components {
            margin: 32px;
            line-height: 2;
        }

        .add {
            display: none;
        }

        .qty {
            margin: 10px 30px;
        }
    </style>
</head>

<body class="home">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="{{url('/')}}">Categories</a>
                </li>
                <li>
                    <a href="#" class="feature_product">Feature Products</a>
                    <ul class="add">
                        <li><a href="#">Add Product</a></li>
                        <li><a href="#">Add Category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" aria-expanded="false">Suggestion</a>
                </li>
            </ul>

        </nav>
        <!-- Page Content -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ($products as $pro) {
                    ?>
                        <div class="col-md-4" style="margin: 0 30px;">
                            <div class="card" style="width: 18rem;">
                                <a href="#">
                                    <img class="card-img-top" src="{{$pro->image}}" alt="Card image cap" height="250px">
                                </a>
                                <div class="card-body">
                                    <a href="{{url('/get-product/')}}">
                                        <h5 class="card-title">{{$pro->pname}}</h5>
                                        <span>Price : {{$pro->price}}/-</span>
                                    </a><br>
                                    <input type="hidden" value="{{$pro->id}}" id="Pro_Id">
                                    <button type="button" class="btn btn-info btn-sm mt-2 mr-5 addtocart" data-id="{{$pro->id}}" onclick="addToCart('{{$pro->id}}')">Add To Cart</button>
                                    <span class="qty">
                                        <input type="button" onclick="decrementValue('{{$pro->id}}')" value="-" />
                                        <input type="text" name="quantity" value="1" maxlength="2" max="10" size="1" id="quantity_{{$pro->id}}" readonly />
                                        <input type="button" onclick="incrementValue('{{$pro->id}}')" value="+" />
                                    </span>

                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <?php ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
</body>
<script>
    $(document).ready(function() {

        $('.feature_product').click(function() {
            $('.add').toggle("slow");
        });
    });

    function addToCart(item) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let qty = $('#quantity_'+item).val();
        $.ajax({
            type: "POST",
            url: "{{url('/add-to-cart')}}",
            data: {
                'proId': item,
                'quantity' : qty,
            },
            success: function(response) {
                console.log(response.data);
            }
        });
        location.reload(true);
    }



    function incrementValue(id) {

        var value = parseInt(document.getElementById('quantity_' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            document.getElementById('quantity_' + id).value = value;
        }

        $.ajax({
            type: "POST",
            url: "{{url('/product-quantity-incr')}}",
            data: {
                'qty': value,
                'proID': id
            },
            success: function(response) {
                $('#total_cart_count').html(response.data['cart_count']);
                console.log(response.data);
            }
        });
    }

    function decrementValue(id) {
        var value = parseInt(document.getElementById('quantity_' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            document.getElementById('quantity_' + id).value = value;
        }
        $.ajax({
            type: "POST",
            url: "{{url('/product-quantity-decreament')}}",
            data: {
                'qty': value,
                'proID': id
            },
            success: function(response) {
                $('#total_cart_count').html(response.data['cart_count']);
                console.log(response);
            }
        });

    }


    $(document).ready(function() {

        qauntity();

        function qauntity() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{url('/product/item-quantity')}}",
                success: function(response) {
                    console.log(response.data);
                    // for (var i = 0; i < response.data.length; i++) {
                    //     $('#quantity').html('');
                    //     $('#quantity').html(response.data[i]['quantity']);
                    //     console.log(response.data[i]['quantity']);
                    // }
                }
            });

        }
    });
</script>

</html>
@endsection