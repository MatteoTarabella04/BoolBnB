<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $apartments = Auth::user()->apartments;
        $messages = [];

        foreach ($apartments as $apartment) {
            $apartment_messages = $apartment->messages->sortByDesc('send_date');
        
            if(count($apartment_messages) > 0) {
                foreach ($apartment_messages as $apartment_message) {
                    array_push($messages, $apartment_message);
                }
            }
        };

        usort($messages, array("App\Http\Controllers\Admin\MessageController", "sortByDescDate"));

        return view('admin.messages.index', compact('messages', 'apartments'));
    }

    public function sortByDescDate($messageA, $messageB) {
        if ($messageA->send_date == $messageB->send_date) {
            return 0;
        }
        return $messageA->send_date < $messageB->send_date ? 1 : -1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        if(!$message->seen) {
            $message->seen = 1;
            $message->update();
        }
        return view('admin.messages.show', compact("message"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return to_route("admin.messages.index")->with("message", "Messaggio ricevuto da " . $message->full_name . " eliminato");
    }
}
