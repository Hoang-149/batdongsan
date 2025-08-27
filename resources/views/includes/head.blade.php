<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Bat dong san')</title>
<link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon1.png') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<script src="/assets/js/jquery.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script src="https://js.pusher.com/8.3.0/pusher.min.js"></script>
<script src="/assets/js/handle.js"></script>

@vite(['resources/js/app.js', 'resources/css/app.css'])

<script>
    window.Laravel = {
        userId: @json(auth()->check() ? auth()->id() : null),
        csrfToken: @json(csrf_token())
    };
</script>
