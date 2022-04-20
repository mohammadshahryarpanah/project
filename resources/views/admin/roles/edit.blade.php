@extends('admin.layout.master')



@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">  ویرایش نقش کاربر  {{$role->name}} </h3>
            </div>
        @include('admin.partials.form-errors')
        <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form id="myForm" method="post" action="/admin/update/role/{{$role->id}}">
                            <input type="hidden" name="_method" value="PUT">

                            @csrf
                            <div class="form-group">
                                <label for="title">نام نقش</label>
                                <input type="text" name="name" class="form-control" value="{{$role->name}}" placeholder="عنوان نقش را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="category_parent">نقش های کاربران</label>
                                <select name="permission_ids[]" id="" class="form-control" multiple >
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}" @if($role->permissions->contains($permission->id)) selected @endif  >{{$permission->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
