@extends('layouts.mainLayout')

@section('title', 'dashboardAlgolus')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-6">
<button class="btn btn-success"><a href="{{route('dash.dossier.create')}}">cree dossier</a></button>
            </div>
        </div>



        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">nomdossier</th>
            <th scope="col">nom d'utilisateur</th>
            <th scope="col">nombre des fichiers</th>
            <th scope="col">les Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossier as $d)
                
            
            <tr>
            <th>{{$d->name}}</th>
            <td>{{$d->user->name}}</td>
            <td>{{$d->created_at}}</td>
            <td>
                <button type="button" class="btn btn-primary"><i class="mdi mdi-eye-outline"></i></button>
                <a href="{{route('dash.dossier.edit',['id'=>$d->id])}}"><button type="button" class="btn btn-success"><i class="mdi mdi-pencil-outline"></i></button></a>
            <button type="button" class="btn btn-danger"><i class="mdi mdi-trash-can-outline"></i></button>
            </td>
            </tr>
            
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
@endsection