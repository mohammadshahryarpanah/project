@extends('admin.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right" style="margin-top:24%;font-family: Tahoma;font-size: 27px;color: black">سطوح دسترسی</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.partials.form-errors')
                @if(Session::has('add_permission'))
                    <div class="alert alert-danger">
                        <div>{{session('add_permission')}}</div>
                    </div>
                @endif

                @if(Session::has('delete_permission'))
                    <div class="alert alert-danger">
                        <div>{{session('delete_permission')}}</div>
                    </div>
                @endif

                @if(Session::has('update_permission'))
                    <div class="alert alert-danger">
                        <div>{{session('update_permission')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table"  style="margin-top: 10%">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">عنوان</th>
                            <th class="text-left">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td class="text-center">{{$permission->id}}</td>
                                <td>{{$permission->name}}</td>
                                <td class="text-right">
                                <td style="display: flex">


                                    <form method="POST" action="{{route('permission.destroy',$permission->id)}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                        <div class="form-group">
                                            <input class="btn btn-danger" type="submit" value="حذف">
                                        </div>
                                    </form>
                                    <div style="margin-right: 20px">

                                        <a class="btn btn-success" href="{{route('permission.edit',$permission->id)}}">ویرایش</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>

@endsection
