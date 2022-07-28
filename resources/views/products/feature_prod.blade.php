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
                    <a href="{{url('/feature-product')}}">Feature Products</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Suggestion</a>
                </li>
            </ul>

        </nav>
        <!-- Page Content -->
        <div id="content">
            <h4 class="" style="margin: 20px 250px;">This Page for Feature Product</h4>
        </div>
    </div>
</body>

</html>

<script>
    // $(document).ready(function() {

    //     $("#sidebar").mCustomScrollbar({
    //         theme: "minimal"
    //     });

    //     $('#sidebarCollapse').on('click', function() {
    //         $('#sidebar').toggleClass('active');
    //     });

    // });

    // $("#sidebar").mCustomScrollbar({
    //     theme: "minimal"
    // });

    // $('#sidebarCollapse').on('click', function() {
    //     // open or close navbar
    //     $('#sidebar').toggleClass('active');
    //     // close dropdowns
    //     $('.collapse.in').toggleClass('in');
    //     // and also adjust aria-expanded attributes we use for the open/closed arrows
    //     // in our CSS
    //     $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    // });
</script>
@endsection