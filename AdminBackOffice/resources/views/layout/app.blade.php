<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body class="bg-light">

@include('includes.header')

<main role="main" class="container">

    <div class="card">
        <div class="card-body">

            @yield('content')

        </div>
    </div>

</main>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@stack('scripts')

</body>
</html>
