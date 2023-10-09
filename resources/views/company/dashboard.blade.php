<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Company Dashboard!</title>
    <style>
        .dropdown {
            display: block;
 
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Company Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
            
            
            </ul>
            
              <div class="d-flex">

                <form id="logout-form" action="{{ route('company.logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
                <a id="logout-link" class="dropdown-item" href="{{ route('company.logout') }}">
                  {{ __('Logout') }}
              </a>
              
            
         
            
            
            </div>
        
          </div>
        </div>
      </nav>




{{-- container start--}}
<div class="container">
    <div class="row">
        <div class="col">
    <!-- Button trigger modal -->
    <div class="mb-3 mt-4">
        <button type="button" class="btn btn-primary btn-sm" id="add_product" data-bs-toggle="modal" data-bs-target="#addModal">
            Add Product
        </button>
    </div>
    <div class="mb-3">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Sr.No</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            @if (empty($product))
             
            <tbody id="list_product">
                @foreach ($products as $product)
              <tr id="row_product_{{ $product->id  }}">
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    {{-- <button class="btn btn-success btn-sm ml-1" id="edit_product" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $product->id  }}">Edit</button> --}}
                    <button class="btn btn-danger btn-sm ml-1" id="delete_product" data-id="{{ $product->id  }}">Delete</button>
                    <button type="button" class="btn btn-success btn-sm" id="edit_product_btn" data-toggle="modal" data-target="#editModal" data-id="{{ $product->id  }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">Edit</button>
                </td>
              </tr>
            @endforeach
            
            </tbody>
            @else
            <tbody>
            <tr><span>No Data Found</span></tr>
            </tbody>
          @endif
          </table>
    </div>
        </div>
    </div>
</div>

{{-- modal start --}}

  
  <!-- Modal -->
  <div class="modal fade " id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title">Create product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form_product">
                @csrf <!-- CSRF Token -->
                <div class="mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="price">Product price</label>
                    <input type="number" class="form-control" id="price" name="price" >
                </div>
                <!-- Add more form fields as needed -->
                <button type="submit" id="modal_btn" class="btn btn-primary btn-sm">Save</button>
            </form>
           

      </div>
    </div>
  </div>
  </div>
{{-- modal end --}}
  
  <!-- edit Modal -->
 



  <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form_product_update" >
            @csrf <!-- CSRF Token -->
            @method('PUT') <!-- Use the PUT method for updates -->
            <input type="hidden" id="product_id" name="product_id">
            <div class="mb-3">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name"  required>
            </div>
            <div class="mb-3">
                <label for="price">Product price</label>
                <input type="number" class="form-control" id="price" name="price"  required>
            </div>
            <!-- Add more form fields as needed -->
            <button type="submit" class="btn btn-primary btn-sm" id="update_product_btn" >Update</button>
        </form>
           
          

      </div>
    </div>
  </div>
</div>
{{-- modal end --}}
{{-- container end --}}


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <script type="text/javascript">

$(document).ready(function () {
    $('#logout-link').on('click', function (e) {
        e.preventDefault();
        $('#logout-form').trigger('submit');
    });
});


   $(document).ready(function(){
    $.ajaxSetup({
        headers:{
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        }
    })
 
    var myModal = document.getElementById('addModal')



    $('#add_product').on('click',function(){

         
        $('#form_product').trigger('reset');
         $('#modal_title').html('Add New product');
        
    });




$(document).ready(function () {
    $('#form_product').on('submit', function (e) {
        e.preventDefault();
             

        $.ajax({
            url: 'product/store', // Adjust the URL based on your route
            method: 'POST',
            data: $(this).serialize(), // Serialize the form data
            dataType: 'json', // Expect JSON response
            success: function (data) {
                // Handle success, e.g., display a success message or redirect
                console.log('product data saved:', data);
                $(myModal).modal('hide');
                $('#form_product').trigger('reset');
                // You can redirect the user to another page if needed
                location.reload();
            },
            error: function (xhr, status, error) {
                // Handle errors, e.g., display validation errors
                console.error('Error:', xhr.responseJSON);
                // Display validation errors (assuming JSON response)
                if (xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        // Display errors for each form field
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '-error').html(value[0]);
                    });
                }
            }
        });

      
    });
  

    $(document).ready(function () {
   $("body").on('click','#edit_product_btn',function(){

        // var id=$(this).data('id');
        var productId = $(this).data('id');
        var productName = $(this).data('name');
        var productprice = $(this).data('price');
        $('#editModal #product_id').val(productId);
        $('#editModal #name').val(productName);
        $('#editModal #price').val(productprice);
        // alert(id);
        // var url='product/'+id+'/edit';
        $('#modal_title').html('Edit product');
            $('#modal_btn').html('Update');
        // alert('hjfsdh');
        $('#editModal').modal('show');
      
        //  $('#form_product').trigger('reset');
          // $('#modal_title').html('Edit product');
         
     });
    
    });

    $(document).ready(function () {
   

    $('#form_product_update').on('submit', function (e) {
     e.preventDefault();

      var productId = $('#product_id').val();

        var newName = $('#name').val();
        var newprice = $('#price').val();


        var updateURL='product/'+productId+'/update';

        $.ajax({
            url: updateURL,
            method: 'PUT', 
            
             data: $(this).serialize() + '&_token={{ csrf_token() }}', 
                  
       
            dataType: 'json',
            success: function (response) {
              
              if (response.success) {
        
        $('#editModal').modal('hide');
        location.reload();
    } else if (response.errors) {
        
        // console.log(response.errors);
    } else {
        // Handle other errors
    }
            },
            error: function (xhr, status, error) {
                // Handle AJAX errors or display error messages
            }
        });

    });
  });
// });
});

// delete
$(document).ready(function () {
  $("body").on('click','#delete_product',function(){
    // $('#delete_product').on('click', function () {
        var productId = $(this).data('id'); // Get the product ID from the data attribute

        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: 'product/' + productId+'/delete', // Adjust the URL based on your route
                method: 'DELETE', // Use the DELETE method for deletion
                data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                    }, // Serialize the form data
                dataType: 'json', // Expect JSON response
                success: function (data) {
                    // Handle success, e.g., remove the deleted row
                    console.log('product deleted:', data);
                    $(myModal).modal('hide');
                $('#form_product').trigger('reset');
                // You can redirect the user to another page if needed
                location.reload();
                    // $('#row_product_' + productId).remove(); // Remove the table row
                },
                error: function (xhr, status, error) {
                    // Handle errors, e.g., display an error message
                    console.error('Error:', xhr.responseJSON);
                    alert('An error occurred while deleting the product.');
                }
            });
        }
    });
});



});


   </script>
  </body>
</html>