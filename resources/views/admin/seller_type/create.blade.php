@extends('admin.layout.master')


@section('content')

    <section class="content">
        <div class="box box-info mt-3">
            <div class="box-header " style="margin-top: 30%">
                <h3 class="box-title pull-right ">ایجاد  نوع فروشنده جدید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="margin-top: 20%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                        <form id="myForm" method="post" action="{{route('type.store')}}" enctype="multipart/form-data">
                        @include('admin.partials.form-errors')
                            @csrf
                            <div class="form-group">
                                <label for="title"> عنوان نوع فروشنده</label>
                                <input type="text" name="title" class="form-control" placeholder=" عنوان نوع فروشنده را وارد کنید..." value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label for="description">توضیحات:</label>
                                <textarea id=""  class="form-control" name="description"  >{{old('description')}}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="city"> شهر </label>
                                <select name="city_id" id="" class="form-control">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <input type="file" name="image" >
                            </div>

                            <button type="submit" class="btn btn-success pull-left" style="margin-top: 10%">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
