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
                        <form id="" method="post" action="{{route('ticket.store')}}" enctype="multipart/form-data">
                        @include('admin.partials.form-errors')
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                            @csrf
                            <div class="form-group">
                                <label for="title">تاریخ شروع</label>
                                <input id="InputStartDate" type="text" name="start_date" class="form-control" placeholder=" تاریخ شروع را وارد کنید..." value="{{old('start_date')}}">
                            </div>

                            <div class="form-group">
                                <label for="title">نام بلیط </label>
                                <input id="InputStartDate" type="text" name="name" class="form-control" placeholder=" لطفا نام بلیط را وارد کنید..." value="{{old('name')}}">
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

                            <div class="form-group">
                                <label for="title"> موجودی بلیط</label>
                                <input id="InputQty" type="text" name="qty" class="form-control" placeholder=" موجودی بلیط را وارد کنید..." value="{{old('qty')}}">
                            </div>

                            <div class="col-md-6">
                                <label for="title">  تصویر</label>
                                <input id="InputLogo" type="file" name="image" >
                            </div>

                            <button type="submit" class="btn btn-success btn-submit" style="margin-top: 10%">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

        <script type="text/javascript">

            $('#SubmitForm').on('submit',function(e){
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                e.preventDefault();

                let formData = new FormData(this)
                let start_date = $('#InputStartDate').val();
                let end_date = $('#InputEndDate').val();
                let start_time = $('#InputStartTime').val();
                let end_time = $('#InputEndTime').val();
                let qty = $('#InputQty').val();
                let image = $('#InputLogo').files;


                $.ajax({
                    url: "{{route('ticket.store')}}",
                    type:"POST",
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded'},
                    data:{
                        formData
                    },
                    success:function(response){
                        $('#successMsg').show();
                        console.log(response);
                    },
                    error: function(response) {
                        console.log(response)
                        // $('#nameErrorMsg').text(response.responseJSON.errors.name);
                        // $('#statusErrorMsg').text(response.responseJSON.errors.email);

                    },
                });
            });

    </script>

    <script>


{{--        $(document).ready(function (){--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            $("#SubmitForm").on('submit',(function(e){--}}
{{--                e.preventDefault();--}}
{{--                let formData = new FormData(this)--}}

{{--                formData.append('start_date', $("#InputStartDate").val());--}}
{{--                formData.append('end_date', $("#InputEndTimeDate").val());--}}
{{--                formData.append('start_time', $("#InputStartTime").val());--}}
{{--                formData.append('end_time', $("#InputEndTime").val());--}}
{{--                formData.append('qty', $("#InputQty").val());--}}
{{--                formData.append("image",$("#InputLogo")[0].files[0]);--}}


{{--                $.ajax({--}}
{{--                    url: "{{route('ticket.store')}}",--}}
{{--                    type: "POST",--}}

{{--                    data:{--}}
{{--                        formData--}}
{{--                    },--}}
{{--                    contentType: false,--}}
{{--                    cache: false,--}}
{{--                    processData:false,--}}
{{--                    success: function(data){--}}

{{--                    },--}}
{{--                });--}}
{{--            }));});--}}

{{--    </script>--}}




@endsection
