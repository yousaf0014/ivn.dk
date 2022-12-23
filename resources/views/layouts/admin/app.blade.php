<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVN    - @yield('title') </title>
    <link href="{{url('images/favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}" type="image/x-icon">
    @yield('css')
</head>
<body>
    <input id="crf_token" value="{{ csrf_token() }}" type="hidden">
  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('layouts.admin.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.admin.topnavbar')

            <!-- Main view  -->
            @include('layouts.admin.flashmessage')
            @yield('content')            

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->

<!-- Footer -->
<div class="clearfix"></div>
<?php /* @include('layouts.admin.footer') */?>

<script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>

@section('scripts')
@show

</body>
</html>
