<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample School Management System</title>
    <!-- Include your CSS and JS files here -->
</head>
<body>
    <header>
        <nav>
            <!-- Your navigation menu -->
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('students.index') }}">Students</a></li>
                <li><a href="{{ route('teachers.index') }}">Teachers</a></li>
                <!-- Add more menu items as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <!-- Your footer content -->
    </footer>

    <!-- Include your JavaScript at the bottom of the page -->
</body>
</html>