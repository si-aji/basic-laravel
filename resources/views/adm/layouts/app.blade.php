<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ (isset($wsecond_title) && !empty($wsecond_title) ? $wsecond_title.' - ' : '').($wtitle ?? env('APP_NAME')) }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">

        @yield('css_plugins')
        @yield('css_inline')

        {{-- Plugins --}}
        {{-- <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}"> --}}
        <link href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css') }}" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar Container -->
            @include('adm.layouts.partials.navbar')

            <!-- Main Sidebar Container -->
            @include('adm.layouts.partials.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Breadcrumb Wrapper -->
                @if(isset($wheader) && isset($wheader))
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>{{ $wheader['header_title'] }}</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        @foreach($wheader['header_breadcrumb'] as $br)
                                            <li class="breadcrumb-item {{ $br['is_active'] ? 'active' : '' }}">
                                                @if($br['is_active'])
                                                    {{ $br['title'] }}
                                                @else
                                                    <a href="{{ $br['url'] }}">{{ $br['title'] }}</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                @endif

                @if(Session::get('message'))
                    <div class="container-fluid">
                        <section class="px-2">
                            <div class="alert alert-{{ Session::get('status') ?? 'info' }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5>
                                    @if(Session::get('message_icon'))
                                    <i class="icon fas fa-{{ Session::get('message_icon') ?? 'info' }}"></i>
                                    @endif {{ Session::get('status') ? ucwords(Session::get('status')) : 'Info' }}!</h5>
                                {{ Session::get('message') }}
                            </div>
                        </section>
                    </div>
                @endif

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Footer Container -->
            @include('adm.layouts.partials.footer')
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>

        @yield('js_plugins')
        @yield('js_inline')

        {{-- Sweetalert --}}
        <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    </body>
</html>
