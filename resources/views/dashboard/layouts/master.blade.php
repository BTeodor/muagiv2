<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title') | {{ settings('app_name') }}</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles-end')
        {!! Html::style(elixir('css/dashboard.css')) !!}
        @yield('after-styles-end')
        <script type="text/javascript" src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
        <!-- <script type="text/javascript" src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script> -->
        <script type="text/javascript" src="{{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap-switch.min.css')}}" />
        <link rel="stylesheet" href="{{asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />
        <script type="text/javascript" src="{{asset('assets/js/bootstrap-switch.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}">
        <script type="text/javascript" src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
        <script type="text/javascript">
            var $j214 = jQuery.noConflict();
        </script>
        <script src="{{asset('assets/js/jquery-ui.custom.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-tokenfield.custom.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-tokenfield.css')}}">
        @if(isset($keywords))
            <script type="text/javascript">
                $(function(){
                    var keywords = <?php echo '["' . implode('", "', $keywords) . '"]' ?>;
                    console.log(keywords);
                    $j214('#keywords').tokenfield({
                      autocomplete: {
                        source: keywords,
                        delay: 100,
                        minLength: 1
                      },
                      showAutocompleteOnFocus: true
                    }).on('tokenfield:createtoken', function (event) {
                        var existingTokens = $j214(this).tokenfield('getTokens');
                        $j214.each(existingTokens, function(index, token) {
                            if (token.value === event.attrs.value)
                                event.preventDefault();
                        });
                    });
                });
            </script>
        @endif
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-{{ settings('theme_skin') }} sidebar-mini">
    <div class="wrapper">
        @include('dashboard.includes.header')
        @include('dashboard.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('page-header')
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('dashboard.includes.footer')
    </div><!-- ./wrapper -->

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    @yield('before-scripts-end')
    {!! Html::script(elixir('js/dashboard.js')) !!}
    {!! Html::script('vendor/jsvalidation/js/jsvalidation.js') !!}
    @yield('after-scripts-end')
    </body>
</html>