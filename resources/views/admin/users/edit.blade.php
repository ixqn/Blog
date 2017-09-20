@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                用户修改
                <small>Add administrator</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">修改用户状态信息</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->


                        @if (count($errors) > 0)
                            <div id="alertError" class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> 提示!!!</h4>
                                <ul>
                                    @if(is_object($errors))
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @else
                                        <li>{{ $errors }}</li>
                                    @endif
                                </ul>
                            </div>
                        @endif

                        <form role="form" action="{{url('admin/users/'.$users->user_id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="box-body">
                                <label for="exampleInputEmail1">状态</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" id="optionsRadios1" value="0"  @if(old('status') == '正常') checked="checked" @endif >正常
                                    </label>
                                    <label>
                                        <input type="radio" name="status" id="optionsRadios2" value="1"  @if(old('status') == '限制登录') checked="checked" @endif >限制登录
                                    </label>
                                    <label>
                                        <input type="radio" name="status" id="optionsRadios2" value="2"  @if(old('status') == '帐号被封,不可登录') checked="checked" @endif >帐号被封,不可登录
                                    </label>
                                </div>
                            </div>


                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">确认修改</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $('#alertError').fadeOut(3000);
    </script>
@endsection