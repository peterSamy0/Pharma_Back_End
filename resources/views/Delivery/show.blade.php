<!DOCTYPE html>
<html>
<head>
    <title>Show Delivery</title>
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
        <h1 class="display-4">Delivery Details</h1>
    </header>
    <div class="container w-75">
        <div class="card p-3 shadow ">
            <div class="card-content ">
                <h2>ID: {{ $delivery['id'] }}</h2>
                <p>Name: {{ $delivery->user['name'] }}</p>
                <p>NationalID: {{ $delivery['national_ID'] }}</p>
                <p>Governorate: {{ $delivery->governorate['governorate'] }}</p>
                <p>City: {{ $delivery->city['city'] }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
