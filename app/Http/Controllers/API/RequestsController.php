<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestsRequest;
use App\Models\Requests;

class RequestsController extends Controller
{
    public function create(RequestsRequest $requestsRequest)
    {
        try {
            $user_id=Auth::user()->id;

            $requests=new Requests;
            $requests->user_id=$user_id;
            $requests->object=$requestsRequest->object;
            $requests->typeRequest=$requestsRequest->typeRequest;
            $requests->description=$requestsRequest->description;

            if($requestsRequest->hasFile('letter'))
            {
                $letter=$requestsRequest->file('letter', )->store('files/letters', 'public');
            }
            $requests->letter=$letter;

            $requests->save();

            return response()->json([
                'message'=>"Demande envoyé avec succès",
                'status'=>200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'=>$e->getMessage(),
                'message'=>"Erreur d'enregistrement, vérifier bien les données"
            ]);
        }
    }
    //
}
