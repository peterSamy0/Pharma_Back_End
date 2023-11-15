<!DOCTYPE html>
<html>

<head>
    <title>Add Medication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
<div class="login-page bg-light my-5">
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="bg-white shadow rounded">
            <div class="row">
              <div class="col-md-7 pe-0">
                <div class="form-left h-100 py-5 px-5">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                 
                    @endforeach
                    @endif
                  <form
                    class="row g-4"
                    action="{{ route('medications.store') }}" method="POST"
                    enctype="multipart/form-data"
                  >
                  @csrf
                    <h2 class="mb-2 text-capitalize">Add your Medication</h2>
  
                    <div class="col-12">
                      <label class="form-label"></label>
                      <div>
                        <label for="name" class="form-label text-dark">Name</label>
                <input type="text" id="name" name="name" class="form-control"
                value="{{old('name')}}">
                          
                        
                      </div>
                      @error('name')
                      <small class="text-danger">the name feild is required</small>
                      @enderror
                    </div>
  
                    <div class="col-12">
                      <label class="form-label"></label>
                      <div>
                        <label for="price" class="form-label text-dark">Price</label>
                <input type="number" id="name" name="price" class="form-control" 
                value="{{old('price')}}">
                      </div>
                      @error('price')
        <small class="text-danger">the price feild is required</small>
      @enderror
                    </div>
  
                    <div class="col-12">
                        <label class="form-label"></label>
                        <label for="exampleInputPassword1" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>Select Category</option>
                          @foreach ($data as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option
                            value="{{old('category_id')}}">
                          @endforeach
                        </select
                       >
                    </div>
                    <div class="col-12">
                    <label class="form-label"></label>
                    <div>
                      <label for="description" class="form-label text-dark">Description</label>
                      <input type="text" id="description" name="description" class="form-control"
                      value="{{old('description')}}">
                    </div>
                    @error('description')
                    <small class="text-danger">the description feild is required</small>
                     @enderror
                  </div>
                    @error('category_id')
                    <small class="text-danger">the category feild is required</small>
                     @enderror
                    <div class="col-12">
                      <label class="form-label"></label>
                      <div>
                        <label for="image" class="form-label text-dark">Image</label>
                        <input type="file" id="image" name="image" class="form-control"
                        value="{{old('image')}}">
                      </div>
                      @error('image')
                      <small class="text-danger">the image feild is required</small>
                  @enderror
                    </div>
                    <div class="col-12">
                      <button
                        type="submit"
                        class="btn px-4 float-end mt-4"
                        style="background-color: rgb(123, 211, 222); border: none"
                      >
                        Add Product
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-5 ps-0 d-none d-md-block">
                <img
                  style="width: 100%; height: 100%"
                  src="https://i.pinimg.com/236x/95/b4/75/95b4750ba1598129969ba24d08d5b659.jpg"
                  alt=""
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
</body>

</html>