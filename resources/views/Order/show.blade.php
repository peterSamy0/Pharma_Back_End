<!DOCTYPE html>
<html>
<head>
    <title>Show Order</title>
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
        <h1 class="display-4">Order Details</h1>
    </header>
    <div class="container w-75">
        <div class="card p-3 shadow ">
            <div class="card-content ">
                <h2>ID: {{ $order['id'] }}</h2>
                <p>Status: {{ $order['status'] }}</p>
                {{-- <p>Amount: {{ $order->orderMedications['amount'] }}</p> --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
