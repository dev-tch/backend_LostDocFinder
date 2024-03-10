<?php

namespace App\Http\Controllers;

use App\Models\document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $documents = Document::where('user_id', $userId)->get();
        // Return the documents as JSON
        return $documents->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $iduser = Auth::id();
        /*$request->request->add(['user_id' => $iduser]);*/
        $document = new Document($request->all());
        $document->user_id = $iduser;
        if($document->save()){
            return response()->json([
            'message' => 'Successfully created Document!',
            ],201);
        }
        else{
            return response()->json(['error'=>'Failed to create Docuement'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $doc_id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, document $document)
    public function update(Request $request, $doc_id)
    {
        $new_desc = $request->input('doc_description');
        //$documentId = $request->input('doc_id');
        Log::info("update doc id: ".$doc_id );
        Log::info("update doc  newdesc: ". $new_desc );
        $document = Document::find($doc_id);

        if ($document) {
            // Document found, proceed with deletion
            //$document->delete();
            $document->doc_description = $new_desc;
            $document->save();
            return response()->json([
                'message' => 'Successfully updated document!',
            ], 200);
        } else {
            // Document not found
            return response()->json([
                'error' => 'Document not found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $documentId = $request->input('doc_id');
        Log::info("destroy document: ".$documentId  );

        $document = Document::find($documentId);

        if ($document) {
            // Document found, proceed with deletion
            $document->delete();
            return response()->json([
                'message' => 'Successfully deleted document!',
            ], 200);
        } else {
            // Document not found
            return response()->json([
                'error' => 'Document not found!',
            ], 404);
        }
    }
    public function description(Request $request){
        $doc_id   = $request->input("doc_id");
        $doc_type = $request->input("doc_type");

        $document = Document::where('doc_id', $doc_id )
        ->where('doc_type', $doc_type )
        ->first();

        if ($document) {
            $description = $document->doc_description;
            return response()->json([
                'message' => $description,
            ], 200);
        } else {
            // Document not found
            return response()->json([
                'error' => 'document description not found!',
            ], 404);
        }
    }
}
