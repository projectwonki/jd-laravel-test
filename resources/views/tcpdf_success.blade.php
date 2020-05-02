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

    <div class="container">
    <div class="center">
        <h5>Convert is done.. 2 files has been dropped at storage folder</h5>
    </div>
    </div>
    
@endsection