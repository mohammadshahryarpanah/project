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

                        <form method="post" action="{{route('type.update',$seller->id)}}" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">


                            <div class="form-group">
                                <label for="title">نام فروشنده</label>
                                <input type="text" name="name" class="form-control" placeholder=" نام  فروشنده را وارد کنید..." value="{{$seller->name}}">
                            </div>

                            <div class="form-group">
                                <label for="description">آدرس:</label>
                                <textarea id=""  class="form-control" name="address"  >{{$seller->address}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">توضیحات:</label>
                                <textarea id=""  class="form-control" name="description"  >{{$seller->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="title">شماره تماس</label>
                                <input type="number" name="phone_number" class="form-control" placeholder=" نام  فروشنده را وارد کنید..." value="{{$seller->phone_number}}">
                            </div>

                            <div class="form-group">
                                <label for="city"> شهر </label>
                                <select name="city_id" id="" class="form-control">
                                    @foreach($seller_type as $type)
                                        <option value="{{$type->id}}" @if($seller->seller_type_id == $type->id) selected @endif  >{{$type->title}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="city"> ثبت بلیط </label>
                                <select name="ticket_ids[]" id="InputType" class="form-control" multiple="multiple">
                                    @foreach($tickets as $ticket)
                                        <option value="{{$ticket->id}}" @if($seller->tickets->contains($ticket->id)) selected @endif >{{$ticket->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="title"> تصویر پس زمینه</label>
                                <input type="file" name="image" >
                            </div>

                            <div class="col-md-6">
                                <label for="title">  لوگو</label>
                                <input type="file" name="logo" >
                            </div>
                            <button type="submit" class="btn btn-success pull-left">بروزرسانی</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
