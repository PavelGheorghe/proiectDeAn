<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title>{{trans('lang.cmd.artisan_cmd_area')}}</title>
    <base href="<?php echo url('/'); ?>"/>

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body class="animated fadeInDown">

<div class="container-fluid">

    <h3 class="title">{{trans('lang.cmd.artisan_commands')}}</h3>
    <hr>
    <a href="/cmd/artisan/config:cache" id="config_cache" class="btn btn-primary">{{trans('lang.cmd.config_cache')}}</a>

    <a href="/cmd/artisan/config:clear" class="btn btn-primary">{{trans('lang.cmd.config_clear')}}</a>

    <a href="/cmd/artisan/cache:clear" class="btn btn-primary">{{trans('lang.cmd.cache_clear')}}</a>

    <a href="/cmd/artisan/route:clear" class="btn btn-primary">{{trans('lang.cmd.route_clear')}}</a>

    <a href="/cmd/artisan/view:clear" class="btn btn-primary">{{trans('lang.cmd.view_clear')}}</a>

    <a href="/cmd/artisan/migrate" class="btn btn-primary">{{trans('lang.cmd.migrate')}}</a>

    <hr>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <b>{{trans('lang.cmd.seeding_instruction')}}</b>
        </div>
    </div>

    <hr>
    <h3 class="title">{{trans('lang.cmd.commands_output')}}</h3>
    <hr id="artisan_commands_separator">
    @if(session('output'))
        <pre>{{ session('output') }}</pre>
    @endif
</div>

<!--================================================== -->

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>
<!-- BOOTSTRAP JS -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#config_cache').click(function () {
            const commands_separator = $('#artisan_commands_separator');
            commands_separator.append('<p>{{trans('lang.cmd.configuration_cache_cleared')}}</p><p>{{trans('lang.cmd.configuration_cached_successfully')}}</p>');
        });
    });
</script>

</body>
</html>

