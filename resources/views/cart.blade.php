@extends('index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-5">
            <h5>Data Cart</h5>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                @if($cart->count() > 0)
                @foreach($cart as $row)
                <tr>
                    <th scope="row">{{ $row->id }}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->image }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>{{ $row->price }}</td>
                </tr>
                @endforeach
                @else 
                <tr>
                    <td colspan='5'>Cart is empty</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-2">
            <h5>See Product Page</h5>
            <a href="{{ url('product') }}" class="btn btn-primary">Click</a>
        </div>
    </div>
</div>
@endsection