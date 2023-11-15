<!DOCTYPE html>
<html>

<head>
    <title>Edit Medication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <header class=" bg-light text-dark">
        <h1 class="text-left" style="color: #3c6167">Edit Medication</h1>
    </header>
    <div class="container w-50">
     
        <form class="card p-4" action="{{ route('medications.update', $medication->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label text-dark">Name</label>
                <input type="text" id="name" name="name" value="{{ $medication['name'] }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label text-dark">Price</label>
                <input type="text" id="price" name="price" value="{{ $medication['price'] }}" class="form-control">
            </div>

            {{-- <div class="mb-3">
                <label for="category" class="form-label text-dark">Category</label>
                <input type="text" id="category" name="category" value="{{ $medication->category['name'] }}" class="form-control">
            </div> --}}

            <button type="submit" class="btn btn-secondary w-100 mt-3">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>