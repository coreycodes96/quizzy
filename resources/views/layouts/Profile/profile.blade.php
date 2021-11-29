<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quizzy | Profile</title>

        {{-- Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js" integrity="sha512-eP6ippJojIKXKO8EPLtsUMS+/sAGHGo1UN/38swqZa1ypfcD4I0V/ac5G3VzaHfDaklFmQLEs51lhkkVaqg60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollToPlugin.min.js" integrity="sha512-nTHzMQK7lwWt8nL4KF6DhwLHluv6dVq/hNnj2PBN0xMl2KaMm1PM02csx57mmToPAodHmPsipoERRNn4pG7f+Q==" crossorigin="anonymous"></script>

        {{-- Initializing the gsap timeline --}}
        <script>
            const tl = new TimelineLite();
        </script>
    </head>
    <body>
        <div id="app">
            {{-- Header --}}
            <user-header username="{{auth()->user()->username}}"></user-header>

            {{-- Profile --}}
            <profile-view :auth-id="{{auth()->user()->id}}" :auth-firstname="{{json_encode(auth()->user()->firstname)}}" :auth-surname="{{json_encode(auth()->user()->surname)}}" :auth-username="{{json_encode(auth()->user()->username)}}" :profile-id="{{$id}}" :profile-username="{{json_encode($username)}}"></profile-view>
        </div>
    </body>
</html>
