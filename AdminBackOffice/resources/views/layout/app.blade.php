<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body class="bg-light">

<main role="main" class="container">

    @yield('content')

</main>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@stack('scripts')

</body>
</html>
