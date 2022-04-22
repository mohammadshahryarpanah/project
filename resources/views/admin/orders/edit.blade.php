@extends('admin.layout.master')



@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border" style="margin-top: 40%">
                <h3 class="box-title pull-right">ویرایش کاربر {{$seller->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-top: 30%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">

                        <form method="post" action="{{route('ticket.update',$ticket->id)}}" >
                            @csrf
                            <input name="_method" type="hidden" value="PUT">


                            <div class="form-group">
                                <label for="title">تاریخ شروع</label>
                                <input id="" type="text" name="start_date" class="form-control" placeholder=" تاریخ شروع را وارد کنید..." value="{{$ticket->start_date}}">
                            </div>

                            <div class="form-group">
                                <label for="title">تاریخ پایان</label>
                                <input id="" type="text" name="end_date" class="form-control" placeholder=" تاریخ پایان را وارد کنید..." value="{{$ticket->end_date}}}">
                            </div>

                            <div class="form-group">
                                <label for="title"> ساعت شروع</label>
                                <input id="" type="text" name="start_time" class="form-control" placeholder=" ساعت شروع را وارد کنید..." value="{{$ticket->start_time}}">
                            </div>

                            <div class="form-group">
                                <label for="title"> ساعت پایان</label>
                                <input id="" type="text" name="end_time" class="form-control" placeholder=" ساعت پایان را وارد کنید..." value="{{$ticket->end_time}}">
                            </div>

                            <div class="col-md-6">
                                <label for="title">  تصویر</label>
                                <input id="logo" type="file" name="image" >
                            </div>

                            <button type="submit" class="btn btn-success pull-left">بروزرسانی</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
