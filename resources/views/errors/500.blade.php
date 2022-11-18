<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 Server Error</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">500</h2>
            <p class="display-5">Oops! &#128546; Something get wrong</p>
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('home') }}'">Go Courses</button>
        </div>
    </div>
</body>
</html>