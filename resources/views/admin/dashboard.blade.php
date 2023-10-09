<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Admin Dashboard!</title>
    <style>
        .dropdown {
            display: block;
 
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Admin Dashboard</a>
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

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
                <a id="logout-link" class="dropdown-item" href="{{ route('admin.logout') }}">
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
        <button type="button" class="btn btn-primary btn-sm ml-2" id="add_company" data-bs-toggle="modal" data-bs-target="#addModal">
            Add Company
        </button>
        <a href="{{ route('notifications.index') }}"><button type="button" class="btn btn-info btn-sm ml-auto" >
          Notifications
      </button></a>
    </div>
    <div class="mb-3">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Sr.No</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            @if (empty($company))
             
            <tbody id="list_company">
                @foreach ($companies as $company)
              <tr id="row_company_{{ $company->id  }}">
                <th scope="row">{{ $company->id }}</th>
                <td>{{ $company->name }}</td>
                <td>{{ $company->address }}</td>
                <td>
                    {{-- <button class="btn btn-success btn-sm ml-1" id="edit_company" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $company->id  }}">Edit</button> --}}
                    <button class="btn btn-danger btn-sm ml-1" id="delete_company" data-id="{{ $company->id  }}">Delete</button>
                    <button type="button" class="btn btn-success btn-sm" id="edit_company_btn" data-toggle="modal" data-target="#editModal" data-id="{{ $company->id  }}" data-name="{{ $company->name }}" data-address="{{ $company->address }}">Edit</button>
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
          <h5 class="modal-title" id="modal_title">Create Company</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form_company">
                @csrf <!-- CSRF Token -->
                <div class="mb-3">
                    <label for="name">Company Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="address">Company Address</label>
                    <input type="text" class="form-control" id="address" name="address" >
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
          <h5 class="modal-title" id="modal_title">Edit Company</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form_company_update" >
            @csrf <!-- CSRF Token -->
            @method('PUT') <!-- Use the PUT method for updates -->
            <input type="hidden" id="company_id" name="company_id">
            <div class="mb-3">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" id="name" name="name"  required>
            </div>
            <div class="mb-3">
                <label for="address">Company Address</label>
                <input type="text" class="form-control" id="address" name="address"  required>
            </div>
            <!-- Add more form fields as needed -->
            <button type="submit" class="btn btn-primary btn-sm" id="update_company_btn" >Update</button>
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



    $('#add_company').on('click',function(){

         
        $('#form_company').trigger('reset');
         $('#modal_title').html('Add New Company');
        
    });




$(document).ready(function () {
    $('#form_company').on('submit', function (e) {
        e.preventDefault();
             

        $.ajax({
            url: 'company/store', // Adjust the URL based on your route
            method: 'POST',
            data: $(this).serialize(), // Serialize the form data
            dataType: 'json', // Expect JSON response
            success: function (data) {
                // Handle success, e.g., display a success message or redirect
                console.log('Company data saved:', data);
                $(myModal).modal('hide');
                $('#form_company').trigger('reset');
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
   $("body").on('click','#edit_company_btn',function(){

        // var id=$(this).data('id');
        var companyId = $(this).data('id');
        var companyName = $(this).data('name');
        var companyAddress = $(this).data('address');
        $('#editModal #company_id').val(companyId);
        $('#editModal #name').val(companyName);
        $('#editModal #address').val(companyAddress);
        // alert(id);
        // var url='company/'+id+'/edit';
        $('#modal_title').html('Edit Company');
            $('#modal_btn').html('Update');
        // alert('hjfsdh');
        $('#editModal').modal('show');
      
        //  $('#form_company').trigger('reset');
          // $('#modal_title').html('Edit Company');
         
     });
    
    });

    $(document).ready(function () {
   

    $('#form_company_update').on('submit', function (e) {
     e.preventDefault();

      var companyId = $('#company_id').val();

        var newName = $('#name').val();
        var newAddress = $('#address').val();


        var updateURL='company/'+companyId+'/update';

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
  $("body").on('click','#delete_company',function(){
    // $('#delete_company').on('click', function () {
        var companyId = $(this).data('id'); // Get the company ID from the data attribute

        if (confirm('Are you sure you want to delete this company?')) {
            $.ajax({
                url: 'company/' + companyId+'/delete', // Adjust the URL based on your route
                method: 'DELETE', // Use the DELETE method for deletion
                data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                    }, // Serialize the form data
                dataType: 'json', // Expect JSON response
                success: function (data) {
                    // Handle success, e.g., remove the deleted row
                    console.log('Company deleted:', data);
                    $(myModal).modal('hide');
                $('#form_company').trigger('reset');
                // You can redirect the user to another page if needed
                location.reload();
                    // $('#row_company_' + companyId).remove(); // Remove the table row
                },
                error: function (xhr, status, error) {
                    // Handle errors, e.g., display an error message
                    console.error('Error:', xhr.responseJSON);
                    alert('An error occurred while deleting the company.');
                }
            });
        }
    });
});



});


   </script>
  </body>
</html>