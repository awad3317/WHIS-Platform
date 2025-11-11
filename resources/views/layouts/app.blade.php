<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        @yield('title', 'مدارس وادي حضرموت العالمية')
    </title>
    <link href="{{ asset('tailadmin/build/style.css') }}" rel="stylesheet">

    <meta name="description"
        content="مدارس وادي حضرموت العالمية تقدم تعليمًا متميزًا وفق المعايير الدولية، تجمع بين الإبداع الأكاديمي والتربية الأخلاقية في بيئة تعليمية حديثة.">
    <meta name="keywords"
        content="مدارس وادي حضرموت، تعليم عالمي، مدارس دولية، تعليم، وادي حضرموت، مدارس خاصة، مناهج دولية، تعليم متميز">
    <meta name="author" content="مدارس وادي حضرموت العالمية">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="مدارس وادي حضرموت العالمية | تعليم بمعايير دولية">
    <meta property="og:description"
        content="مدارس وادي حضرموت العالمية تقدم برامج تعليمية متطورة لبناء جيل مبدع وقائد.">
    <meta property="og:image" content="{{ asset('favicons/favicon-96x96.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="مدارس وادي حضرموت العالمية | تعليم بمعايير دولية">
    <meta name="twitter:description"
        content="مدارس وادي حضرموت العالمية تقدم برامج تعليمية متطورة لبناء جيل مبدع وقائد.">


    <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicons/favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/favicon-96x96.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">

</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <x-sidebar />

        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Small Device Overlay Start -->
            <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
            <!-- Small Device Overlay End -->

            <!-- ===== Header Start ===== -->
            <x-header />
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    {{-- <div class="grid grid-cols-12 gap-4 md:gap-6"> --}}
                    @yield('content')
                    {{-- </div> --}}
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    <script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
</body>

</html>
