<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="es"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta mane="robots" content="noindex nofollow"/>
    <meta name="msapplication-tap-highlight" content="no"/>   
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/ico/favicon.ico') }}" />    <meta name="_token" content="{{ csrf_token() }}" />   
    <title>App NextSofts Global Corporation</title>
    <!-- uikit -->
    <link href="{{ asset('/bower_components/uikit/css/uikit.almost-flat.min.css') }}" rel="stylesheet" media="all">
    <!-- flag icons -->
    <link href="{{ asset('/assets/icons/flags/flags.min.css') }}" rel="stylesheet" media="all">
    <!-- altair admin -->
    <link href="{{ asset('/assets/css/main.min.css') }}" rel="stylesheet" media="all">

    @yield('styles')
</head>
<body class="@yield('body') @yield('color_body') @yield('sindebar_body')">
    <!-- main content -->
    @yield('page')
    <!-- main content end -->
    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = "{{ URL::asset('/assets/js/googleapis.webfont.js') }}";
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <!-- common functions -->
    <script src="{{ URL::asset('/assets/js/common.min.js') }}"></script>
    <!-- uikit functions -->
    <script src="{{ URL::asset('/assets/js/uikit_custom.min.js') }}"></script>
    <!-- altair common functions/helpers -->
    <script src="{{ URL::asset('/assets/js/altair_admin_common.min.js') }}"></script>
    @yield('scripts')
    <script>
        $(function() {
            // enable hires images
            altair_helpers.retina_images();
            // fastClick (touch devices)
            if(Modernizr.touch) {
                FastClick.attach(document.body);
            }
        });
    </script>
</body>
</html>