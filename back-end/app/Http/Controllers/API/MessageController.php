<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Message;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        date_default_timezone_set('Europe/Rome');
        $data["send_date"] = date('Y-m-d H:i:s', time());

        $new_message = new Message();
        $new_message->fill($data);
        $new_message->save();

        // COMMENTED TO AVOID MAIL SENDING
        // Mail::to(env("MAIL_TO_ADDRESS"))->send(new NewContact($new_message));

        //TODO controllare che sia stata inviata correttamente
        // if() {
            return response()->json([
                "success" => true,
                "data" => $new_message,
            ]);
        // } else {
            return response()->json([
                "success" => false,
            ]);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
