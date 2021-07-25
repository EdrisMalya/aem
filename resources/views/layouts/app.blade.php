<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{asset('plugins/materialize/materialize.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('styles.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap-helper.css')}}">
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <link rel="icon" href="{{asset('img/logo.png')}}">
    <link rel="stylesheet" href="{{asset('plugins/selectize/selectize.min.css')}}">
    @livewireStyles
    @stack('css')
    {{$css??''}}
</head>
<body>
    {{$slot}}
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @livewireScripts
    <script src="{{asset('alpine.min.js')}}"></script>
    <script src="{{asset('js/livewire-turbolinks.js')}}" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <script src="{{asset('plugins/materialize/materialize.min.js')}}"></script>
    <script src="{{asset('plugins/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('init.js')}}"></script>
    <script src="{{asset('js.js')}}"></script>
    {{$js??''}}
    @stack('js')
    @if(session()->has('message'))
        <script>
            M.toast({
                html: '{{session()->get('message')}}',
                classes: '{{session()->has('classes')?session()->get('classes'):'green rounded'}}'
            });
        </script>
    @endif
</body>
</html>
