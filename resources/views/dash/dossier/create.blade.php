@extends('layouts.mainLayout')
@section('title', 'dashboardAlgolus')

@section('content')
<form action="{{ route('dash.dossier.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    
<section class="vh-100" >
    <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-9">

        <h1 class=" mb-4">cree un dossier </h1>
        @if (session('erorr'))
        <div class="alert">dossier deja existe si vous voulais le modifier click ici</div>
    @endif
        <div class="card" style="border-radius: 15px;">
            <div class="card-body">

            <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-3 ps-5">

                <h6 class="mb-0">nom de dossier</h6>

                </div>
                <div class="col-md-9 pe-5">

                <input type="text" class="form-control form-control-lg" name="dossiername"/>

                </div>
            </div>


            <hr class="mx-n3">

            <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">

                <h6 class="mb-0">Upload fichier</h6>

                </div>
                <div class="col-md-9 pe-5">

                <input class="form-control form-control-lg" id="formFileLg" name="dossierfiles[]" type="file" multiple/>
                <div class="small text-muted mt-2">tu peut choisier un ou plus des fichiers</div>

                </div>
            </div>

            <hr class="mx-n3">

            <div class="px-5 py-4">
                <button type="submit" class="btn btn-primary btn-lg">confirmer creation</button>
            </div>

            </div>
        </div>

        </div>
    </div>
    </div>
</section>
</form>

@endsection