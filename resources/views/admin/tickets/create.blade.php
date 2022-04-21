@extends('admin.layout.master')


@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
{{--    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}



    <section class="content">
        <div class="box box-info mt-3">
            <div class="box-header " style="margin-top: 30%">
                <h3 class="box-title pull-right ">ایجاد بلیط </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="margin-top: 20%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                        <form id="SubmitForm">
                        @include('admin.partials.form-errors')
                            @csrf
                            <div class="form-group">
                                <label for="title">تاریخ شروع</label>
                                <input id="InputStartDate" type="text" name="start_date" class="form-control" placeholder=" تاریخ شروع را وارد کنید..." value="{{old('start_date')}}">
                            </div>

                            <div class="form-group">
                                <label for="title">تاریخ پایان</label>
                                <input id="InputEndDate" type="text" name="end_date" class="form-control" placeholder=" تاریخ پایان را وارد کنید..." value="{{old('end_date')}}">
                            </div>

                            <div class="form-group">
                                <label for="title"> ساعت شروع</label>
                                <input id="InputStartTime" type="text" name="start_time" class="form-control" placeholder=" ساعت شروع را وارد کنید..." value="{{old('start_time')}}">
                            </div>

                            <div class="form-group">
                                <label for="title"> ساعت پایان</label>
                                <input id="InputEndTime" type="text" name="end_time" class="form-control" placeholder=" ساعت پایان را وارد کنید..." value="{{old('end_time')}}">
                            </div>

                            <div class="col-md-6">
                                <label for="title">  تصویر</label>
                                <input id="logo" type="file" name="image" >
                            </div>

                            <button type="submit" class="btn btn-success btn-submit" style="margin-top: 10%">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $("#SubmitForm").click(function(e){



            e.preventDefault();



            var start_date = $("input[name=start_date]").val();
            var end_date = $("input[name=end_date]").val();
            var start_time = $("input[name=start_time]").val();
            var end_time = $("input[name=end_time]").val();
            var qty = $("input[name=qty]").val();
            var image = $("input[name=image]").val();



            $.ajax({

                type:'POST',

                url:"{{ route('ticket.store') }}",

                data:{start_date:start_date, end_date:end_date, start_time:start_time,end_time:end_time,qty:qty,image:image},

                success:function(data){

                    alert(data.success);

                }

            });



        });

    </script>

@endsection
