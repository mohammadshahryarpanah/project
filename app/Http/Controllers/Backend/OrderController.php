<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Seller_Ticket;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
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
            'start_date'=>['required','string'],
            'start_time'=>['required','string'],

        ],[


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {

            $data=[];
            foreach ($request->ticket_ids as $ticket_id){
                $data[]=[
                    'user_id'=>$request->user_id,
                    'seller_id'=>$request->seller_id,
                    'ticket_id'=>$ticket_id,
                    'start_date'=>$request->start_date,
                    'start_time'=>$request->start_time
                ];
            }
            Order::query()->insert($data);
            return redirect()->to(route('order.index'));
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
            return redirect()->to(route('order.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

}
