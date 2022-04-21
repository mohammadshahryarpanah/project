@extends('admin.layout.master')


@section('content')

    <section class="content">
        <div class="box box-info mt-3">
            <div class="box-header " style="margin-top: 30%">
                <h3 class="box-title pull-right ">ایجاد فروشنده جدید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="margin-top: 20%">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                        <form id="SubmitForm">
                        @include('admin.partials.form-errors')
                            @csrf
                            <div class="form-group">
                                <label for="title">نام فروشنده</label>
                                <input id="InputName" type="text" name="name" class="form-control" placeholder=" نام  فروشنده را وارد کنید..." value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label for="description">آدرس:</label>
                                <textarea id="InputAddress"  class="form-control" name="address"  >{{old('address')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">توضیحات:</label>
                                <textarea id="InputDescription"  class="form-control" name="description" >{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="title">شماره تماس</label>
                                <input id="InputPhone" type="number" name="phone_number" class="form-control" placeholder=" نام  فروشنده را وارد کنید..." value="{{old('phone_number')}}">
                            </div>


                            <div class="form-group">
                                <label for="city"> نوع فروشنده </label>
                                <select name="seller_type_id" id="InputType" class="form-control">
                                    @foreach($seller_type as $type)
                                        <option value="{{$type->id}}">{{$type->title}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="title"> تصویر پس زمینه</label>
                                <input id="image" type="file" name="image" >
                            </div>

                            <div class="col-md-6">
                                <label for="title">  لوگو</label>
                                <input id="logo" type="file" name="logo" >
                            </div>

                            <button type="submit" class="btn btn-success pull-left" style="margin-top: 10%">ذخیره</button>
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
            let phone_number = $('#InputPhone').val();
            let address = $('#InputAddress').val();
            let description = $('#InputDescription').val();
            let seller_type_id = $('#InputType').val();
            let image = $('#image').val();
            let logo = $('#logo').val();

            $.ajax({
                url: "{{route('seller.store')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    name:name,
                    address:address,
                    description:description,
                    seller_type_id:seller_type_id,
                    image:image,
                    logo:logo,

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
