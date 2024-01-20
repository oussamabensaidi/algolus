<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Fichier;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File; 

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

History::create([
'user_id'=>$user->id,
'description'=> 'le utulisateur : ` '.$user->name.' ` a cree le dossier : '.$request->input('dossiername'),
]);
    return redirect()->route('dash.dossier.index');

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
        $user = auth()->user();
        $dossier = Dossier::findOrFail($id);
        $oldnom = $dossier->name;
        $dossier->name = $request->input('name');
        $dossier->save();

        History::create([
            'user_id'=>$user->id,
            'description'=> 'le utulisateur :" '.$user->name.' " a modifier le nom de dossier : " '.$oldnom.' "vers un novau nom que est : ` '.$dossier->name." `. le id c'est : ".$dossier->id,
            ]);
        return redirect()->route('dash.dossier.edit',['id'=>$id]);
    }


    public function downloadFile($user_service ,$user_id , $f_name){
        $user = auth()->user();
        History::create([
            'user_id'=>$user->id,
            'description'=> 'le utulisateur :` '.$user->name.' ` a telecharger le fichier depuit ce lien :  '.public_path("storage/public/uploads/".$user_service."/".$user_id."/".$f_name)
        ]);
    return response()->download(public_path("storage/public/uploads/".$user_service."/".$user_id."/".$f_name));
}
    public function deleteFile($id){
        $file = Fichier::findOrFail($id);
        $user = auth()->user();
        History::create([
            'user_id'=>$user->id,
            'description'=> 'le utulisateur : ` '.$user->name.' ` a supprimer le fichier depuit ce lien :'.public_path("storage/".$file->name)
        ]);
        File::delete(public_path("storage/".$file->name));
        $file->delete();
        return redirect()->back();
}
    public function addFile(Request $request ){


        $user = $request->user();
        $userFolder = 'public/uploads/'.$user->service_id .'/'. $user->id;


        foreach ($request->file('dossierfiles') as $file) {
            $fileName = now()->format('Y-m-d').'__'.$file->getClientOriginalName();
            $file->move(Storage::disk('public')->path($userFolder), $fileName);
            Fichier::create([
                'user_id' => $user->id,
                'name' => $userFolder . '/' . $fileName,
            ]);
            History::create([
                'user_id'=>$user->id,
                'description'=> 'le utulisateur : ` '.$user->name.' ` a ajouter un fichier de lien : '.$userFolder . '/' . $fileName
            ]);

        }
        return redirect()->back();
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folder = Dossier::findOrFail($id);
        
        $user = auth()->user();
        History::create([
            'user_id'=>$user->id,
            'description'=> 'le utulisateur : ` '.$user->name.' ` a supprimer le dossier depuit ce lien :'.public_path("storage/public/uploads/".$folder->user_id)
        ]);
        $directories = public_path("storage/public/uploads/".$folder->user_id);
        File::deleteDirectory( $directories);

        $folder->delete();
        // return redirect()->back()->with(['msg' => "vous avez supprimer dossier :".$folder->name]);
        return redirect()->back()->with(['msg' => public_path("storage/public/uploads/".$folder->user_id)]);
    }
    
}
