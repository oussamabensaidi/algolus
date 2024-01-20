@extends('layouts.mainLayout')
@section('title', 'dashboardAlgolus')

@section('content')


<div class="container">
    <div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-6">
                <h3>nom de utulisateur :{{$user->name}}</h3>
                <h1>nom de dossier :{{$dossier->name}}</h1>
            </div>
            <div class="col-6">
                <form  action="{{ route('dash.dossier.update',['id'=>$dossier->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="name">Nouvau nom </label>
                    <input type="text" name="name" value="">
                    <button type="submit">Modifier nom</button>
                </form>
                <div class="row">
                    <form  action="{{ route('addFile') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div>
                            <input type="file" name="dossierfiles[]" multiple>
                            <button type="submit" class="btn btn-success">ajouter un fichier</button>
                        </div>
                    </form>
            </div>
                
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
    <form action="{{ route('deleteFile', ['id' => $f->id]) }}" method="post">
        @csrf
        @method('DELETE')
    <a href="" style="color:white">
        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this record?')"> 
            <span class="mdi mdi-trash-can-outline"></span>
        </button>
    </a> 
        
    </form>



    </td>
    
</tr>
@endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>

@endsection