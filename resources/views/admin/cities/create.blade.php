@extends('admin.layout.master')



@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right" style="margin-top:30%;font-family: Tahoma;font-size: 27px;color: black">ایجاد شهر</h3>
            </div>
        @include('admin.partials.form-errors')
        <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form id="SubmitForm">
                            @csrf
                            <div class="form-group">
                                <label for="title" style="margin-top: 50%;font-family: Tahoma;color: black;font-weight: bold">نام  شهر</label>
                                <input id="InputName" type="text" name="name" class="form-control" placeholder="نام شهر را وارد کنید...">
                            </div>

                            <div class="form-group">
                                <label for="status">وضعیت:</label>
                                <select class="form-control" id="InputStatus" name="status"><option value="1">فعال</option><option value="0" selected="selected">غیرفعال</option></select>
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <script type="text/javascript">

        $('#SubmitForm').on('submit',function(e){
            e.preventDefault();

            let name = $('#InputName').val();
            let status = $('#InputStatus').val();

            $.ajax({
                url: "{{route('city.store')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    name:name,
                    status:status,

                },
                success:function(response){
                    $('#successMsg').show();
                    console.log(response);
                },
                error: function(response) {
                    $('#nameErrorMsg').text(response.responseJSON.errors.name);
                    $('#statusErrorMsg').text(response.responseJSON.errors.email);

                },
            });
        });
    </script>

@endsection
