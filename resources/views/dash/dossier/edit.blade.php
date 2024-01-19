@extends('layouts.mainLayout')
@section('title', 'dashboardAlgolus')

@section('content')


<div class="container">
    <div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-6">
<h1>nom de dossier :{{$dossier->name}}</h1>
<h3>nom de utulisateur :{{$user->name}}</h3>
            </div>
        </div>



        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">les fichiers </th>
            <th scope="col">les actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fichiers as $f)
            <tr>
    <td>{{$f->name}}</td>
    <td>
    <a href="{{url('downloadFile/'.$f->name)}}" target="blink" style="color:white">
        <button class="btn btn-primary"> 
            <span class="mdi mdi-arrow-down"></span>
        </button>
    </a>

    <a href="" target="blink" style="color:white">
        <button class="btn btn-danger"> 
            <span class="mdi mdi-trash-can-outline"></span>
        </button>
    </a>


    </td>
    
</tr>
@endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>

@endsection