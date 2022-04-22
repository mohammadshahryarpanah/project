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
                <h3 class="box-title pull-right" style="margin-top:11%;font-family: Tahoma;font-size: 27px;color: black">لیست بلیط ها </h3>

                <div class="text-left">
{{--                    <a class="btn btn-app" href="{{route('attributes-group.create')}}">--}}
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table " style="margin-top: 10%;">
                        <thead>
                        <tr>

                            <th class="text-center " style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" > تاریخ شروع</th>
                            <th class="text-center " style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" > تاریخ پایان</th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" > ساعت شروع</th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >ساعت پایان</th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >موجودی </th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >تصویر </th>
                            <th class="text-center" style="font-family: Tahoma;font-size: 16px;color: #0c0c0c" >عملیات</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>

                                <td class="text-center">{{$seller->start_date}}</td>
                                <td class="text-center">{{$seller->end_date}}</td>
                                <td class="text-center">{{$seller->start_time}}</td>
                                <td class="text-center">{{$seller->end_time}}</td>
                                <td class="text-center">{{$seller->qty}}</td>
                                <td>  <img src="{{ asset('storage/images/'.$ticket->path) }}" class="img-fluid"
                                           width="80">
                                </td>
                                <td class="text-center" style="display: flex">
                                    <a class="btn btn-warning" href="{{route('ticket.edit', $ticket->id)}}">ویرایش</a>
                                    <div class="display-inline-block">
                                        <form method="post" action="{{route('ticket.destroy',$ticket->id)}}">
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
