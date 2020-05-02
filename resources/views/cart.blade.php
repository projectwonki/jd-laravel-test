@extends('index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-5">
            <h5>Data Cart</h5>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price (after discount)</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @if($cart->count() > 0)
                @php $i = 1; @endphp
                @foreach($cart as $row)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $row->name }}</td>
                    <td><img src="{{ URL::asset($row->image) }}" alt="" height="100" width="100"></td>
                    <td>{{ $row->discount }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>Rp {{ number_format($row->price,0,'','.') }},-</td>
                    <td>
                        <button type="submit" class="btn btn-danger deletecart" data-id="{{ $row->id }}">Delete Item</button> 
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
                <tr>
                    <td colspan="4">Total</td>
                    <td>{{ $sum_of_qty_cart }}</td>
                    <td>Rp {{ number_format($sum_of_cart_price,0,'','.') }},-</td>
                </tr>
                @else 
                <tr>
                    <td colspan='6'>Cart is empty</td>
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

<script>
    $('.deletecart').click(function(){
      var conf = confirm("Want to delete this item?");

      if (conf === false) {
          return false;
      }

      var id = $(this).attr('data-id');

      $.ajax({
          url : "{{ url('delete-cart') }}",
          type : "post",
          data : {
              "id" : id,
          },
          success:function(data) {
              console.log(data);

              if(data.status == 'success'){
                alert('delete cart item success!');
                location.reload();
              }else{
                alert(data.status);
              }
          }
      });
    });

</script>
@endsection