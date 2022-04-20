@extends('admin.layout.master')



@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right" style="margin-top:30%;font-family: Tahoma;font-size: 27px;color: black">ایجاد مجوز دسترسی </h3>
            </div>
        @include('admin.partials.form-errors')
        <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form id="myForm" method="post" action="/admin/store/permission">
                            @csrf
                            <div class="form-group">
                                <label for="title" style="margin-top: 50%;font-family: Tahoma;color: black;font-weight: bold">نام مجوز دسترسی</label>
                                <input type="text" name="name" class="form-control" placeholder="عنوان سطح دسترسی را وارد کنید...">
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
