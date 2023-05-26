<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;

class FolderController extends Controller
{
    public function create(FolderRequest $folderRequest)
    {
        try {
            $user_id=Auth::id();

            $folder=new Folder;
            $folder->user_id=$user_id;
            if ($folderRequest->hasFile('photo')) {
                $photo=$folderRequest->file('photo')->store('images/folders', 'public');
             }
            $folder->photo=$photo;
            if($folderRequest->hasFile('filePassport'))
            {
                $filePassport=$folderRequest->file('filePassport', )->store('files/passports', 'public');
            }
            $folder->filePassport=$filePassport;

            //$folder->gender=$folderRequest->gender;
            //$folder->residenceStatus=$folderRequest->residenceStatus;
            $folder->university=$folderRequest->university;
            $folder->city=$folderRequest->city;
            $folder->address=$folderRequest->address;
            $folder->phone=$folderRequest->phone;
            $folder->profession=$folderRequest->profession;
            $folder->job=$folderRequest->job;

            $folder->company=$folderRequest->company;
            $folder->civilStatus=$folderRequest->civilStatus;
            $folder->nbChildren=$folderRequest->nbChildren;
            $folder->firstNameReferent=$folderRequest->firstNameReferent;
            $folder->lastNameReferent=$folderRequest->lastNameReferent;
            $folder->emailReferent=$folderRequest->emailReferent;
            $folder->phoneReferent=$folderRequest->phoneReferent;
            $folder->familyConnection=$folderRequest->familyConnection;
            
            $folder->save();

            return response()->json([
                'folder'=>$folder,
                'status'=>200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'=>$e->getMessage(),
                'message'=>"Erreur d'enregistrement, vérifier bien les données"
            ]);
        }
    }

    public function folderByUser()
    {
        try {
            $user_id=Auth::user()->id;
            $folder=Folder::where('user_id',$user_id)->firstOrFail();

            if($folder===''){
                return response()->json([
                    'message'=>"Cet utilisateur n'a pas de dossier",
                    'status'=>200
                ]);
            }else{
                return response()->json([
                    'folder'=>$folder,
                    'status'=>200
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'error'=>$e->getMessage(),
                'message'=>"Problème rencontré pour la recupération des données"
            ]);
        }
    }
    //
}
