@extends('index')
@section('content')
    <h5><b>Table Employees (Origin)</b></h5>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Salary</th>
          </tr>
        </thead>
        <tbody>
            @foreach($employee as $row)
            <tr>
                <th scope="row">{{ $row->id }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ $row->salary }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <h5>Average Salary (Employees Origin) : {{ number_format($employee_avg, 2, '.', '') }}</h5>
    <br>
    <h5><b>Table Employees (Update)</b></h5>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Salary</th>
          </tr>
        </thead>
        <tbody>
            @foreach($employee_update as $row)
            <tr>
                <th scope="row">{{ $row->id }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ $row->salary }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <h5>Average Salary (Employees Update) : {{ number_format($employee_update_avg, 2, '.', '') }}</h5>
    <br>
    <h5>Somya computes an average salary of <b>{{ number_format($employee_update_avg, 2, '.', '') }}</b>. The actual average salary is <b>{{ number_format($employee_avg, 2, '.', '') }}</b></h5>
    <br>
    <h5>The resulting error between the two calculations is <b>{{ number_format($employee_update_avg, 2, '.', '') }}</b> - <b>{{ number_format($employee_avg, 2, '.', '') }}</b> = <b>{{ number_format($differentiation_result, 2, '.', '') }}</b>
        which, when rounded to the next integer, is <b>{{ round($differentiation_result, 0)}}</b></h5>
@endsection