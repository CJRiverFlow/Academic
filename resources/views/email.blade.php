<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Email Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container col-md-6"> 
        <h4>Available Courses</h4>
        <p>Please enter your data to receive the report with the list of available courses</p>
        <form method="POST" action="/email">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <div class="col-md-6" id="email-field">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                        placeholder="Enter your email">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('home') }}'">Course Details</button>
        </form>
    </div>

</body>
</html>