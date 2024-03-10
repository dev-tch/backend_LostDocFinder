<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocumentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        // Retrieve Requests associated with the authenticated user
        $requests = DocumentRequest::where('user_id', $userId)->get();
        return $requests->toJson();       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*get the current id of authenticated user*/
        $iduser = Auth::id();
        $request->request->add(['user_id' => $iduser]);
        $create_ok = false;
        /*switch the type of request we must handle the status */
        $req_type   = $request->input('req_type');
        $doc_id     = $request->input('doc_id');
        $status     = "";
        $new_status = "";
        if ($req_type == "doc_lost")
        {
            $status     = "Awaiting_reply_finder";
            $new_status = "Responded_reply_finder";
        } 
        else if ($req_type == "doc_found")
        {
            $status     = "Awaiting_reply_owner";
            $new_status = "Responded_reply_owner";
        }
        else {
            $status     = "Undefined_status";
            $new_status = "RUndefined_status";
        }
        //$status= "";
        $request->request->add(['req_status' => $status]);
        $docRequest = new DocumentRequest($request->all());
        if($docRequest ->save())
        {       
            $create_ok = true;
        }
        else{
            $create_ok = false;  
        }
        if ($create_ok){
            $count = $this->updateAllRequests($req_type, $doc_id);
            if ($count > 0)
            {
                $docRequest->req_status = $new_status;
                $docRequest ->save();
            }
            return response()->json([
                'message' => 'Successfully created Request!',
                ],201);
        } else 
        {
            return response()->json(['error'=>'Failed to create Request'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentRequest $documentRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentRequest $documentRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $req_id)
    {
        $new_desc = $request->input('req_description');
        //$documentId = $request->input('doc_id');
        Log::info("id request : ".$req_id );
        Log::info("description request: ". $new_desc );
        $documentRequest = DocumentRequest::find($req_id);

        if ($documentRequest) {
            $documentRequest->req_description = $new_desc;
            $documentRequest->save();
            return response()->json([
                'message' => 'Successfully updated Request!',
            ], 200);
        } else {
            // Request not found
            return response()->json([
                'error' => 'Request not found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $requestocumentId = $request->input('id');
        Log::info("delete document request: ".$requestocumentId );

        $documentRequest = DocumentRequest::find($requestocumentId);

        if ($documentRequest) {
            // Document found, proceed with deletion
            $documentRequest->delete();
            return response()->json([
                'message' => 'Successfully deleted documentRequest!',
            ], 200);
        } else {
            // Document not found
            return response()->json([
                'error' => 'DocumentRequest not found!',
            ], 404);
        }
    }
    /****************helper functions **************/
    function refreshRequests($doc_id,  $req_type, $current_status, $newstatus)
    {
        return DocumentRequest::where('doc_id', $doc_id)
                       ->where('req_type', $req_type)
                       ->where('req_status',$current_status )
                       ->update(['req_status' => $newstatus]);
    }

    function updateAllRequests($req_type, $doc_id)
    {
        $count = 0;
        switch($req_type)
        {
            case 'doc_lost' :
                $count = $this->refreshRequests($doc_id ,
                                                'doc_found',            /*request type found*/
                                                'Awaiting_reply_owner',  /*with current_status waiting response owner of document*/
                                                'Responded_reply_owner' 
                                                );
                break;
            case 'doc_found' :
                $count = $this->refreshRequests($doc_id ,
                                                'doc_lost',            /*request type found*/
                                                'Awaiting_reply_finder',  /*with current_status waiting response owner of document*/
                                                'Responded_reply_finder' 
                                                );
                break;
                default :
                    $count = 0 ;                                             
        }
        return $count ;
    }

    public function getContacts(Request $request)
    {
        $doc_id     =  $request->input('doc_id'); 
        $doc_type   =  $request->input('doc_type');  
        $req_type   =  $request->input('req_type');   
        $req_status = $request->input('req_status');   
        $description = "";
        $phone = 0 ;
        $email = "";
        if ($req_type == "doc_found")
        {
            // search description of request doc_lost
            // search 
            $docreq1 = DocumentRequest::where('doc_id', $doc_id )
                                     ->where('doc_type', $doc_type )
                                     ->where('req_type', 'doc_lost')
                                     ->where('req_status', "Responded_reply_finder")
                                     ->first();
            $user1 = User::where('id', $docreq1->user_id)->first();
            $description = $docreq1->req_description;
            $phone = $user1->phone;
            $email = $user1->email;
        }    
        else if  ($req_type == "doc_lost"){
            // search description of request doc_found
            $docreq2 = DocumentRequest::where('doc_id', $doc_id )
                                     ->where('doc_type', $doc_type )
                                     ->where('req_type', 'doc_found')
                                     ->where('req_status', "Responded_reply_owner")
                                     ->first();
            $user2 = User::where('id', $docreq2->user_id)->first();
            $description = $docreq2->req_description;
            $phone = $user2->phone;
            $email = $user2->email;
        } 

        return response()->json([
            'description' =>  $description , 'phone' =>  $phone , 'email' => $email 
            ],200);

    }
     
}
