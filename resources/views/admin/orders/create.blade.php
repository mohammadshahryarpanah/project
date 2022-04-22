@extends('admin.layout.master')


@section('content')


    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



    <section class="content">
        <div class="box box-info mt-3">


            <div class="box-header " style="margin-top: 30%">
                <h3 class="box-title pull-right ">ایجاد سفارش </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="margin-top: 20%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                        <form id="" >
                        @include('admin.partials.form-errors')
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                            @csrf
                            <div class="form-group">
                                <label for="category_parent">انتخاب کاربر </label>
                                <select name="user_id" id="" class="form-control" >
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_parent">انتخاب فروشنده </label>
                                <select name="seller_id" id="" class="form-control" >
                                    @foreach($sellers as $seller)
                                        <option value="{{$seller->id}}">{{$seller->name}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_parent">انتخاب بلیط </label>
                                <select name="ticket_ids[]" id="" class="form-control" multiple="multiple" >
                                    @if(request()->get('start_date') && request()->get('start_time'))
                                    @foreach($tickets as $ticket)
                                        <option value="{{$ticket->id}}">{{$ticket->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title"> تاریخ</label>
                                <input type="text" name="start_date" class="form-control" placeholder="لطفا تاریخ را وارد کنید..." value="{{old('start_date')}}">
                            </div>

                            <div class="form-group">
                                <label for="title"> ساعت</label>
                                <input type="text" name="start_time" class="form-control" placeholder="لطفا ساعت را وارد کنید..." value=" {{old('start_time')}}">
                            </div>

                            <button type="submit" class="btn btn-success btn-submit" style="margin-top: 10%">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
