<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{ $article->title }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div
    class="w-screen h-screen p-10 relative text-white font-thin"
    style="
        background: linear-gradient(
        135deg,
        rgba(0, 0, 0, 0.2) 0%,
        rgba(0, 0, 0, 0) 65%,
        rgba(0, 0, 0, 0) 100%),
        url({{ $article->image }}) center center, {{ optional($article->primaryTag)->colour }};
        background-size: cover;
    ">

    <div class="absolute bottom-0 right-0 mr-10 -mb-8">
        <i class="bi-{{ $article->icon ?? 'lightbulb-fill' }} opacity-20" style="font-size: 16em; line-height: 0"></i>
    </div>

    <div class="text-8xl font-bold">
        {{ optional($article->primaryTag)->name }}
    </div>

    <div class="text-7xl">
        {{ $article->title }}
    </div>
</div>
</body>
</html>



