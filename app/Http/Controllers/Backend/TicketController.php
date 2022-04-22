<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\services\ImageFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.tickets.index',compact('tickets'));
    }


    public function create()
    {
        return view('admin.tickets.create');

    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'start_date'=>['required','string'],
            'name'=>['required','string'],
            'end_date'=>['required','string'],
            'start_time'=>['required'],
            'end_time'=>['required'],
            'qty'=>['required','integer'],
            'image'=>['required'],


        ],[

        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {

            $storeTicket = new Ticket();
            $storeTicket->start_date = $request->start_date;
            $storeTicket->name = $request->name;
            $storeTicket->end_date = $request->end_date;
            $storeTicket->start_time = $request->start_time;
            $storeTicket->end_time = $request->end_time;
            $storeTicket->qty = $request->qty;
            $storeTicket->path = ImageFileService::upload($request->file('image'));
            $storeTicket->save();
//                        return response()->json(['success'=>'Successfully']);

//            return redirect()->to(route('ticket.index'));
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }


    public function edit($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);

        return view('admin.tickets.edit',compact('ticket'));
    }

    public function update($ticket_id,Request $request)
    {
        $validate_data = Validator::make($request->all(),[

            'start_date'=>['required','string'],
            'end_date'=>['required','string'],
            'start_time'=>['required'],
            'end_time'=>['required'],
            'qty'=>['required','integer'],
            'image'=>['required','file','mimes:jpg,png'],
        ],[

        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }

        try {

            $updateTicket = Ticket::find($ticket_id);
            if (!$updateTicket){
                return back()->withErrors(' فروشنده مورد نظر یافت نشد');
            }
            $updateTicket->start_date = $request->start_date;
            $updateTicket->end_date = $request->end_date;
            $updateTicket->start_time = $request->start_time;
            $updateTicket->end_time = $request->end_time;
            $updateTicket->qty = $request->qty;
            $updateTicket->path = ImageFileService::upload($request->image);
            $updateTicket->save();
            return redirect()->to(route('ticket.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

    public function destroy($ticket_id)
    {
        try {
            $ticket = Ticket::destroy($ticket_id);
            if (!$ticket){
                return back()->withErrors(' بلیط مورد نظر یافت نشد');
            }
            return redirect()->to(route('ticket.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }
}
