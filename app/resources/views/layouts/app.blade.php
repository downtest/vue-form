<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{mix('css/app.css')}}">

        <title>Roman Morozov Form</title>
    </head>
    <body>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            @yield('breadcrumbs')
          </ol>
        </nav>

        <div id="app">
            @yield('content')
        </div>

        <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
    </body>
</html>
