@extends('admin.layout.master')



@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد نقش کاربر </h3>
            </div>
        @include('admin.partials.form-errors')
        <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form id="myForm" method="post" action="/admin/store/role">
                            @csrf
                            <div class="form-group">
                                <label for="title">نام نقش</label>
                                <input type="text" name="name" class="form-control" placeholder="عنوان نقش را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="category_parent">سطوح دسترسی </label>
                                <select name="permission_ids[]" id="" class="form-control" multiple="multiple">
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>

                                    @endforeach
                                </select>
                            </div>

{{--                            @foreach($permissions as $permission)--}}

{{--                                <div class="form-group">--}}

{{--                                    <label>{{$permission->name}}</label>--}}

{{--                                    <select  multiple="multiple" name="state[]">--}}
{{--                                        <option value="{{$permission->id}}">{{$permission->name}}</option>--}}
{{--                                    </select>--}}

{{--                                    <input class="" type="checkbox" name="permission_ids[]" value="{{$permission->id}}">--}}

{{--                                    </input>--}}

{{--                                </div>--}}

{{--                            @endforeach--}}


                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
