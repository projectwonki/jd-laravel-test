@extends('index')

@section('content')

<div class="container-fluid">
      <div class="row">
        <div class="col-5">
            <h5>Data Product</h5>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @php $a = 1; @endphp
                @foreach($product as $row)
                  <tr>
                    <th scope="row">{{ $a }}</th>
                    <td>{{ $row->name }}</td>
                    <td><img src="{{ URL::asset($row->image) }}" alt="" height="100" width="100"></td>
                    <td>Rp {{ number_format($row->price,0,'','.') }},-</td>
                    <td><button type="submit" class="btn btn-primary addtocart" data-productid="{{ $row->id }}" data-price="{{ $row->price }}">Add To Cart</button> 
                        <select name="qty" size="1">
                            @for($i=1;$i<11;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </td>
                  </tr>
                @php $a++; @endphp
                @endforeach
                </tbody>
              </table>
        </div>
        <div class="col-2">
            <h5>See Cart Page</h5>
            <a href="{{ url('cart') }}" class="btn btn-primary">Click</a>
        </div>
        <div class="col-5">
            <h5>Data Discount</h5>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">DIscount Code</th>
                    <th scope="col">Discount Percentage</th>
                  </tr>
                </thead>
                <tbody>
                @if($discount->count() > 0)
                @foreach($discount as $row)
                  <tr>
                    <th scope="row">{{ $row->id }}</th>
                    <td>{{ $row->discount_code }}</td>
                    <td>{{ $row->discount_percentage }}%</td>
                  </tr>
                  @endforeach
                  @else 
                  <tr>
                    <td colspan='5'>Discount is empty</td>
                  </tr>
                  @endif
                </tbody>
              </table>
        </div>
      </div>
  </div>

  <script>
      $('.addtocart').click(function(){
        var productid = $(this).attr('data-productid');
        var price = $(this).attr('data-price');
        var qty = $(this).parents().children("select");

        var dscode = prompt("Please Discount Code (empty this field if you dont want to use discount", "DC10");
        if (dscode === null) {
            return false; //break out of the function early
        }
        // if (person != null) {
          $.ajax({
              url : "{{ url('add-to-cart') }}",
              type : "post",
              data : {
                  "id" : productid,
                  "qty" : qty.val(),
                  "dscode" : dscode,
                  "price" : price,
              },
              success:function(data) {
                  console.log(data);
                  alert(data.status);
              }
          });
        // }
      });

  </script>
@endsection