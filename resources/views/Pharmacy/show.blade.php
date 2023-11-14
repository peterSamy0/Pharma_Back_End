<!DOCTYPE html>
<html>
<head>
    <title>Show Pharmacy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        p {
            text-align: justify;
            text-justify: inter-word;
            font-size: 14px;
            margin: 0; 
            line-height: 2; 
        }
        .description {
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
   <header class="bg-light text-dark">
    <h2>Pharmacy Name: {{  $pharmacy->user['name'] }}</h2>
</header>
    <div class="container w-75">
        <div class="card p-3 shadow ">
            <div class="card-content ">
                {{-- <h2>Pharmacy Name: {{  $pharmacy->user['name'] }}</h2> --}}
                <p>ID: {{ $pharmacy['id'] }}</p>
                <p>Street : {{ $pharmacy['licence_number'] }}</p>
                <p>Governorate: {{ $pharmacy->governorate['governorate'] }}</p>
                <p>City: {{ $pharmacy->city['city'] }}</p>
                <p>Street : {{ $pharmacy['street'] }}</p>
                <p>Opening: {{ $pharmacy['opening'] }}</p>
                <p>Closing: {{ $pharmacy['closing'] }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
