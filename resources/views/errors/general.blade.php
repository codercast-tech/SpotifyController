{{-- resources/views/errors/general.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
</head>
<body>
    <h1>An Error Occurred</h1>
    <p>{{ $message ?? 'Sorry, something went wrong.' }}</p>
</body>
</html>
