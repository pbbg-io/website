<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ mix('css/titan.css') }}">

    <title>{{ config('app.name') }}</title>

</head>
<body>


<div class="d-md-none fixed-top" id="toggle-nav-parent">
    <a href="#" id="toggle-nav" style="padding: 50px;" class="d-block">
        <i class="fas fa-bars"></i>
    </a>
</div>

<nav class="text-center fixed-top d-none d-md-flex justify-content-center align-content-center" id="main-nav">
    <ul class="list-unstyled mb-0 p-2">
        <li class="d-inline-block">
            <a href="#intro" onclick="hideMenu()"><i class="fas fa-raindrops"></i> Intro</a>
        </li>
        <li class="d-inline-block">
            <a href="#install" onclick="hideMenu()"><i class="fas fa-meteor"></i> Install</a>
        </li>

        <li class="d-inline-block">
            <a href="#features" onclick="hideMenu()"><i class="fas fa-puzzle-piece"></i> Features</a>
        </li>
        <li class="d-inline-block">
            <a href="https://pbbg-io.gitbook.io/titan"><i class="fas fa-books"></i> Documentation</a>
        </li>
        <li class="d-inline-block">
            <a href="https://github.com/pbbg-io/titan-demo"><i class="fab fa-github"></i> Github</a>
        </li>
    </ul>
</nav>

@yield('content')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script type="text/javascript">

    (function(){
        document.getElementById('toggle-nav').addEventListener('click', function() {
            let nav = document.getElementById("main-nav");
            nav.classList.toggle('d-flex');
            nav.classList.toggle('open');
        });

    })();

    function hideMenu() {

        document.getElementById('toggle-nav').click();
    }
</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f15b7be07c.js" crossorigin="anonymous"></script>
</body>
</html>
