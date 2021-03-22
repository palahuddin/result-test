<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Counter</title>
    <style>
        section {
            padding: 1em;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }

        div {
            text-align: center;
        }

        .main {
            font-size: 1000%;
        }

        .sub {
            font-size: 200%;
            color: gray;
        }
    </style>
</head>
<body>
    <section>
        <div class="main">{{ $total }}</div>
        <div class="sub">Today: <b>{{ $dailyTotal }}</b></div>
    </section>
</body>
</html>
