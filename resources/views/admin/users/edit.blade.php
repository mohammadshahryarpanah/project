@extends('admin.layout.master')



@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border" style="margin-top: 40%">
                <h3 class="box-title pull-right">ویرایش کاربر {{$user->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin-top: 30%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">

                        <form method="post" action="/admin/update/{{$user->id}}" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">



                            <div class="form-group">
                                <label for="title">  نام کاربر</label>
                                <input type="text" name="name" class="form-control col-md-12 col-md-offset-1" value="{{$user->name}}" placeholder=" نام کاربر  را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="category_parent">نقش های کاربران</label>
                                <select name="role_ids[]" id="" class="form-control" multiple >
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if($user->roles->contains($role->id)) selected @endif >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="title">   شماره موبایل کاربر</label>
                                <input type="text" name="phone_number" class="form-control" value="{{$user->phone_number}}" placeholder=" شماره موبایل کاربر  را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="description">ایمیل</label>
                                <input type="text" name="email" class="form-control" value="{{$user->email}}" placeholder=" ایمیل را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="description">پسورد</label>
                                <input type="password" name="password" class="form-control" value="{{$user->password}}" placeholder=" پسورد را وارد کنید...">
                            </div>

                            <button type="submit" class="btn btn-success pull-left">بروزرسانی</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
