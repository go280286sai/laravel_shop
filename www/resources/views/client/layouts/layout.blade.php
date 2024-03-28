<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{env('APP_URL')}}/assets/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{env('APP_URL')}}/assets/css/magnific-popup.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
          integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{env('APP_URL')}}/assets/css/main.css">
    <link rel="icon" href="{{env('APP_URL')}}/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    @section('style')
    @show
    <meta name="keywords" content="Laravel Store::Ключові слова">
    <meta name="description" content="Laravel Store::Опис">
    <title>{{isset($title)?env('APP_NAME').'::'.$title:env('APP_NAME').'::'.__('messages.main')}}</title>
</head>
<body>

@include('client.layouts.header')

<div class="container">
    <div class="row row_profile">
        @include('client.layouts.left')
        <div class="right_profile col-8">
            @section('content')
            @show
        </div>
    </div>
</div>

<button id="top">
    <i class="fas fa-angle-double-up"></i>
</button>
@include('layouts.footer')

<script src="{{env('APP_URL')}}/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous"></script>
<script src="{{env('APP_URL')}}/assets/js/main.js"></script>
<script src="{{env('APP_URL')}}/assets/js/jquery.magnific-popup.min.js"></script>
@section('js')
    @show
</body>
</html>

