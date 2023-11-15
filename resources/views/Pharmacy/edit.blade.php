<!DOCTYPE html>
<html>

<head>
    <title>Edit Medication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <header class=" bg-light text-dark">
        <h1 class="display-4 ">Edit Medication</h1>
    </header>
    <div class="container w-50">
     
        <form class="card p-4" action="{{ route('pharmacies.update', $pharmacy->id) }}" method="POST">
            @csrf
            @method('PUT')
{{-- @dump($pharmacy->id); --}}
            <div class="mb-3">
                <label for="street" class="form-label text-dark">Street</label>
                <input type="text" id="street" name="street" value="{{ $pharmacy['street'] }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="opening" class="form-label text-dark">Opening</label>
                <input type="time" id="opening" name="opening" value="{{ $pharmacy['opening'] }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>