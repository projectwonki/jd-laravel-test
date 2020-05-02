@extends('index')

@section('content')
    <form id="string_reduce">
        <div class="form-group">
          <label for="exampleInputEmail1">Your String</label>
          <input type="text" class="form-control-sm" id="string">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>
        <h5>Output:</h5> <br>
        <div id="after-submit"></div>
      </form>
    <script>
         $("#string_reduce").on("submit", function(e){
            e.preventDefault();
            
            var a = $('#string').val();
            var b = '';

            if (a.length < 1 || a.length > 100) {
                alert('constraint : 1 <= |your_string| <= 100');
            }
            for (var i=0;i<a.length;i++) {
                if (b.indexOf(a[i]) < 0) {
                    var c = a[i];
                    if (a.split(a[i]).length % 2 == 0) {
                        b += a[i];
                    }
                }
            }

            if (b === '') {
                b = 'Empty String';
            }

            $('#after-submit').html(b);
            return false;
        });
    </script>
@endsection