<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'App Pegawai')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <header class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('employees.index') }}">App Pegawai</a>
            <nav class="nav-links">
                <a href="{{ url('/employees') }}">Employee</a>
                <a href="{{ url('/departments') }}">Department</a>
                <a href="{{ url('/attendances') }}">Attendance</a>
                <a href="{{ url('/positions') }}">Positions</a>
                <a href="{{ url('/salaries') }}">Salary</a>
            </nav>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} App Pegawai</p>
    </footer>
</body>

</html>