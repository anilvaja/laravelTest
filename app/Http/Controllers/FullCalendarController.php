<?php

namespace App\Http\Controllers;
use  App\Models\Event;
use Illuminate\Http\Request;
use Log;

    
class FullCalendarController extends Controller
{
    public function getEvent(){
        if(request()->ajax()){
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
        $events = Event::whereDate('date', '>=', $start)->whereDate('date',   '<=', $end)
                ->get(['id','title','date']);
        return response()->json($events);
        }
        return view('fullcalendar');
        
    }
    public function createEvent(Request $request){
        $data = array_except($request->all(), ['_token']);
        $events = Event::insert($data);
        return response()->json($events);
    }
   
    public function deleteEvent(Request $request){
        $event = Event::find($request->id);
        return $event->delete();
    }
}
