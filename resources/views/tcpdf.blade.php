@extends('index')

@section('content')
    <form action="{{ url('convert-images-to-pdf') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlInput1">image1</label>
            <input type="file" class="form-control-file" name="image1" id="image1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">image2</label>
            <input type="file" class="form-control-file" name="image2" id="image2">
        </div>
        <button type="submit" class="btn btn-primary">Export 2 Images to PDF</button>
    </form>
    
@endsection