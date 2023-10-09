@extends('layouts.app') {{-- Assuming you have a layout file --}}
@section('content')
<div class="container">
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

{{-- {{ dd($cartItems) }} --}}
    <h1>Your Shopping Cart</h1>
    @if (count($cartItems) > 0)
    <table class="table">
        <thead>

            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $cartItem)
            <tr>
                <td>{{ $cartItem->product->name }}</td>
                <td>${{ $cartItem->product->price }}</td>
                <td>{{ $cartItem->quantity }}</td>
                <td>${{ $cartItem->quantity * $cartItem->product->price }}</td>
                {{-- <td>
                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-right">
        <h4>Total: ${{ $cartItem->product->price }}</h4>
        <form action="{{ route('stripe') }}" >
            <input type="hidden" name="product_id" value="{{  $cartItem->product->id }}">
            <input type="hidden" name="product_name" value="{{  $cartItem->product->name }}">
            <input type="hidden" name="price" value="{{  $cartItem->product->price }}">

            <button type="submit" name="checkout" class="btn btn-success btn-sm">Proceed to Checkout</button>
        </form>
        {{-- <a href="{{ route('stripe') }}" class="btn btn-primary">Proceed to Checkout</a> --}}
    </div>
    @else
    <p>Your cart is empty.</p>
    @endif
</div>
@endsection
