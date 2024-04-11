<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Projects</title>
        <style>
            nav {
                width: 100vw;
                height: 50px;
                position: fixed;
                top: 0;
                left: 0;
                background: #007bff;
                display: flex !important;
                align-items: center;
                justify-content: space-evenly;
            }
            a {                
                color: #fff !important;
                font-family: 'Arial', 'sans-serif' !important;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('projects') }}">Projects</a>
                <a href="{{ route('newproject') }}">New Project</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </nav>
        </div>
        @yield('content')
    </body>
</html>
