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
        {{-- <h1 class="display-4">Delivery Details</h1> --}}
        <h2>Delivery Name: {{ $delivery->user['name'] }}</h2>
    </header>
    <div class="container w-75">
        <div class="card p-3 shadow ">
            <div class="card-content ">
                <p>ID: {{ $delivery['id'] }}</p>
                <p>Name: {{ $delivery->user['name'] }}</p>
                <p>NationalID: {{ $delivery['national_ID'] }}</p>
                <p>Governorate: {{ $delivery->governorate['governorate'] }}</p>
                <p>City: {{ $delivery->city['city'] }}</p>
                <!-- Approve Form -->
                <form id="approveForm" action="{{ route('delivery.approveAccount', $delivery['id']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-success p-2 m-2">Approve</button>
                </form>

                <!-- Reject Form -->
                <form id="rejectForm" action="{{ route('delivery.rejectAccount', $delivery['id']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-danger p-2 m-2">Reject</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
