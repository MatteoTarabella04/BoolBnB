<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userApartments = Auth::user()->apartments()->orderByDesc("id")->get();
        $messages = [];
        foreach ($userApartments as $apartment) {
            $apartmentMessages = $apartment->messages()->get();
            if($apartmentMessages) {
                foreach ($apartmentMessages as $singleApartmentMessage) {
                    array_push($messages, $singleApartmentMessage);
                }
            }
        }

        uasort($messages, array("App\Http\Controllers\Admin\DashboardController", "sortByDescDate"));

        $sortedUnreadMessages = [];

        foreach ($messages as $singleMessage) {
            if($singleMessage->seen == 0) {
                array_push($sortedUnreadMessages, $singleMessage);
            }
        }

        return view('admin.dashboard', compact("sortedUnreadMessages"));
    }

    public function sortByDescDate($messageA, $messageB) {
        if ($messageA->send_date == $messageB->send_date) {
            return 0;
        }
        return $messageA->send_date < $messageB->send_date ? 1 : -1;
    }
}
