@extends('layouts.mainLayout')

@section('title', 'dashboardAlgolus')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-6">
            </div>
        </div>



        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">user</th>
            <th scope="col">description</th>
            <th scope="col">date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $h)
            <tr>
            <th>{{$h->user->name}}</th>
            <td>{{$h->description}}</td>
            <td>{{$h->created_at}}</td>
            </tr>
            
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
@endsection