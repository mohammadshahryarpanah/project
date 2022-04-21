@extends('admin.layout.master')
@section('content')



{{--    <form action="{{ route('admin.search') }}">--}}
{{--        <input type="text" name="name" placeholder="جستجو بر اساس نام کاربر" />--}}
{{--        <input type="text" name="phone_number" placeholder="جستجو بر اساس شماره موبایل" />--}}
{{--        <input type="text" name="email" placeholder="جستجو بر اساس ایمیل" />--}}
{{--        <button type="submit">جستجو</button>--}}
{{--    </form>--}}





    <div class="box box-info" >
            <div class="box-header with-border">
                <h3 class="box-title pull-right" style="margin-top:11%;font-family: Tahoma;font-size: 27px;color: black">لیست کاربران </h3>

                <div class="text-left">
{{--                    <a class="btn btn-app" href="{{route('attributes-group.create')}}">--}}
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(\Illuminate\Support\Facades\Session::has('add_user'))
                    <div class="alert alert-success">
                        <div>{{session('add_user')}}</div>
                    </div>
                @endif
                @if(\Illuminate\Support\Facades\Session::has('update_user'))
                    <div class="alert alert-danger">
                        <div>{{session('update_user')}}</div>
                    </div>
                @endif

                    @if(\Illuminate\Support\Facades\Session::has('delete_user'))
                        <div class="alert alert-danger">
                            <div>{{session('delete_user')}}</div>
                        </div>
                    @endif

                    @if(\Illuminate\Support\Facades\Session::has('search_error'))
                        <div class="alert alert-danger">
                            <div>{{session('search_error')}}</div>
                        </div>
                    @endif

                <div class="table-responsive">
                    <table class="table " style="margin-top: 10%;">
                        <thead>
                        <tr>

                            <th class="text-center " style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >تصویر</th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >عنوان نوع فروشنده</th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >توضیحات</th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >عملیات</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sellers as $seller)
                            <tr>
                                <td>  <img src="{{ asset('storage/images/'.$seller->path) }}" class="img-fluid"
                                           width="80">
                                </td>
                                <td class="text-center">{{$seller->title}}</td>
                                <td class="text-center">{{$seller->description}}</td>
                                <td class="text-center" style="display: flex">
                                    <a class="btn btn-warning" href="{{route('type.edit', $seller->id)}}">ویرایش</a>
                                    <div class="display-inline-block">
                                        <form method="post" action="{{route('type.destroy',$seller->id)}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <!-- /.table-responsive -->
            </div>

        </div>

    </section>

@endsection
