<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>{{ $title ?? 'Admin' }}</title>
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
<link rel="icon" href="/backend/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="/backend/assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["/backend/assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="/backend/assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="/backend/assets/css/plugins.min.css" />
<link rel="stylesheet" href="/backend/assets/css/kaiadmin.min.css" />
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="/backend/assets/css/custom.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">
