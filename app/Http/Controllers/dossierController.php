<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Fichier;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\Response;


class dossierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $dossier = Dossier::all();
        $user = User::all();
        return view("dash.dossier.index",['dossier'=>$dossier,'user'=>$user]);
        
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dash.dossier.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user(); 
        $userFolder = 'public/uploads/'.$user->service_id .'/'. $user->id;


        if (!Storage::disk('public')->exists($userFolder)){
        Dossier::create([
            'user_id' => $user->id,
            'name' => $request->input('dossiername'),
            'file_number' => count($request->file('dossierfiles')),
        ]);

            Storage::disk('public')->makeDirectory($userFolder);

    foreach ($request->file('dossierfiles') as $file) {
        $fileName = now()->format('Y-m-d').'__'.$file->getClientOriginalName();
        $file->move(Storage::disk('public')->path($userFolder), $fileName);
        Fichier::create([
            'user_id' => $user->id,
            'name' => $userFolder . '/' . $fileName,
        ]);
    }
    return redirect()->route('dash.index');

}
return redirect()->route('dash.dossier.create')->with(['erorr' => 'msg_eror_dossier_deja_cree']);


        
    






    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $dossier = Dossier::find($id);
        $fichiers = DB::table('fichiers')->where('user_id', '=', $dossier->user_id)
        ->get();
        return view('dash.dossier.edit',['dossier'=>$dossier,'fichiers'=>$fichiers,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $dossier = Dossier::find($id);
        $dossier->name = 'Paris to London';
        $dossier->save();
    }


    public function downloadFile($user_service ,$user_id , $f_name){
    return response()->download(public_path("storage/public/uploads/".$user_service."/".$user_id."/".$f_name));
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
