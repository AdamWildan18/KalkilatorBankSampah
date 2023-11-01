<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>

    {{-- @include('layouts.link') --}}
</head>

<body class="crm_body_bg">

    <!-- main content part here -->
    @include('layouts.sidebar')

    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('layouts.menu')
        <!--/ menu  -->

        {{-- content --}}
        {{-- <div class="main_content_iner overly_inner "> --}}
        @yield('container')
        {{-- </div> --}}
        {{-- endcontent --}}

        <!-- footer part -->
        {{-- @include('layouts.footer') --}}
    </section>
    <!-- main content part end -->

    

    <!--/### CHAT_MESSAGE_BOX  ### -->

    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>

    {{-- @include('layouts.script') --}}
    @yield('script')
</body>
