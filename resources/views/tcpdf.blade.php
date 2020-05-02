@extends('index')

@section('content')

<style>
    .container { 
      height: 200px;
      position: relative;
      /* border: 3px solid;  */
    }
    
    .center {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
    </style>

    {{-- <form action="{{ url('convert-images-to-pdf') }}" method="post" enctype="multipart/form-data"> --}}
        {{-- <div class="form-group">
            <label for="exampleFormControlInput1">image1</label>
            <input type="file" class="form-control-file" name="image1" id="image1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">image2</label>
            <input type="file" class="form-control-file" name="image2" id="image2">
        </div> --}}
    {{-- </form> --}}

    <div class="container">
    <div class="center">
        <a href="{{ url('convert-images-to-pdf') }}" class="btn btn-primary">Export 2 Images to PDF</a>
    </div>
    </div>
    
@endsection