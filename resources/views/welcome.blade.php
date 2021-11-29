<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quizzy</title>

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
        {{-- Header --}}
        <div id="app">
            <guest-header></guest-header>
        </div>

        {{-- Welcome --}}
        <div class="w-full h-screen flex justify-center items-center flex-col select-none">
            <h1 class="text-7xl">Quizzy</h1>
            <p class="mt-5">Create your own quizzes...</p>
        </div>

        {{-- About --}}
        <div class="w-full h-screen flex justify-center items-center flex-col bg-gray-900 text-white select-none">
            <h2 class="text-3xl">What is Quizzy?</h2>
            <p class="mt-5">
                Quizzy was created to allow people to create quizzes and let their
                friends and family join in and take part.
            </p>

            <p class="mt-5">
                So take part and enjoy the features of the website.
            </p>
        </div>
    </body>
</html>
