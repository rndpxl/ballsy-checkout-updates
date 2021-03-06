<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ballsy</title>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>


    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:500,700" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/micromodal.css">

    <script src="/js/referral_modal.js"></script>


    <style>
        .btn {
            cursor: pointer;
            display: inline-block;
            background-color: #060262;
            background-clip: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            border: 1px transparent solid;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            padding: 1.4em 1.7em;
            text-align: center;
            position: relative;
            -webkit-transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, -webkit-box-shadow 0.2s ease-in-out;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, -webkit-box-shadow 0.2s ease-in-out;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, box-shadow 0.2s ease-in-out, -webkit-box-shadow 0.2s ease-in-out;
        }
    </style>
</head>
<body>

@include('partial.header')

@include('partial.messages')

@yield('content')


</body>
</html>