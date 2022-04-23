<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Ticket;
use App\Models\Seller;
use App\Models\Seller_Ticket;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index',compact('orders'));
    }


    public function create(Request $request)
    {
        ;

        $tickets = Ticket::query()->join('seller_ticket','tickets.id','=','seller_ticket.ticket_id')
            ->where('seller_ticket.seller_id',$request->seller_id)
            ->where('tickets.start_date',$request->start_date)
            ->where('tickets.start_time',$request->start_time)
            ->select('tickets.name')
            ->get();

        $users = User::all();
        $sellers = Seller::all();
        return view('admin.orders.create',compact('users','tickets','sellers'));

    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'user_id'=>['required','exists:users,id'],
            'seller_id'=>['required','exists:sellers,id'],
            'ticket_ids'=>['array'],
            'ticket_ids.*'=>['required'],
            'start_date'=>['required','string'],
            'start_time'=>['required','string'],

        ],[


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {
//            dd($request->ticket_ids)

            $tickets = Ticket::query()->whereIn('id', $request->ticket_ids)->select('qty')->get();


            DB::beginTransaction();
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->status =0;
            $order->save();

            $data=[];
            foreach ($request->ticket_ids as $ticket_id){
                $data[]=[
                    'order_id'=>$order->id,
                    'seller_id'=>$request->seller_id,
                    'ticket_id'=>$ticket_id,
                    'count'=>$request->count,
                    'start_date'=>$request->start_date,
                    'start_time'=>$request->start_time
                ];
            }
            foreach ($tickets as $ticket)
            if ($request->count > $ticket->qty) {
                return back()->withErrors('موجودی بلیط به اتمام رسیده است.');
            }
            Order_Ticket::query()->insert($data);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->withErrors($exception->getMessage());
        }
    }


    public function edit($order_id)
    {
        $order = Order::find($order_id);
        return view('admin.orders.edit',compact('order'));
    }

    public function update($order_id,Request $request)
    {
        $validate_data = Validator::make($request->all(),[

            'user_id'=>['required','exists:users,id'],
            'seller_id'=>['required','exists:sellers,id'],
            'ticket_ids'=>['required','array'],
            'ticket_ids.*'=>['exists:tickets,id'],
            'start_date'=>['required','string'],
            'start_time'=>['required','string'],

        ],[


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }


        try {


        }catch (\Exception $exception){

            return back()->withErrors($exception->getMessage());
        }

    }

    public function destroy($order_id)
    {
        try {
            $order = Order::destroy($order_id);
            if (!$order){
                return back()->withErrors('  یافت نشد');
            }

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

}
