@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class=" text-center mb-3 mt-3">All Products</h1>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
           
            @if (empty($product))
          
            @foreach ($products as $product)
            
          <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td> 
              <form action="{{ route('add-to-cart') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <button class="btn btn-info btn-sm" type="submit">Add to Cart</button>
          </form>
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


 @endsection