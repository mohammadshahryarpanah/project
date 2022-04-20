@extends('admin.layout.master')


@section('content')

    <section class="content">
        <div class="box box-info mt-3">
            <div class="box-header " style="margin-top: 40%">
                <h3 class="box-title pull-right ">ایجاد  کاربر جدید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="margin-top: 30%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                        <form id="myForm" method="post" action="/admin/store">
                        @include('admin.partials.form-errors')
                            @csrf
                            <div class="form-group">
                                <label for="title">  نام کاربر</label>
                                <input type="text" name="name" class="form-control col-md-12 col-md-offset-1" placeholder=" نام کاربر  را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="category_parent">نقش کاربر  </label>
                                <select name="role_ids[]" id="" class="form-control" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">   شماره موبایل کاربر</label>
                                <input type="text" name="phone_number" class="form-control" placeholder=" شماره موبایل کاربر  را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="description">ایمیل</label>
                                <input type="text" name="email" class="form-control" placeholder=" ایمیل را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label>پسورد</label>
                                <input type="password" name="password" class="form-control" placeholder=" پسورد را وارد کنید...">
                            </div>


                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
