@extends('admin.layout.master')



@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border" style="margin-top: 40%">
                <h3 class="box-title pull-right">ویرایش کاربر {{$type->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-top: 30%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">

                        <form method="post" action="{{route('type.update',$type->id)}}" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">



                            <div class="form-group">
                                <label for="title"> عنوان نوع فروشنده</label>
                                <input type="text" name="title" class="form-control" placeholder=" عنوان نوع فروشنده را وارد کنید..." value="{{$type->title}}">
                            </div>

                            <div class="form-group">
                                <label for="description">توضیحات:</label>
                                <textarea id=""  class="form-control" name="description"  >{{$type->description}}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="city"> شهر </label>
                                <select name="city_id" id="" class="form-control">
                                    @foreach($cities as $city)
{{--                                        <option value="{{$city->id}}">{{$city->name}}</option>--}}
                                        <option value="{{$city->id}}" @if($type->city_id == $city->id) selected @endif  >{{$city->name}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <input type="file" name="image" >
                            </div>
                            <button type="submit" class="btn btn-success pull-left">بروزرسانی</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
