@extends('layouts/admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                修改密码
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
                            <h3 class="box-title">请输入要修改的信息</h3>
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

                        <form role="form" action="{{url('admin/doamend')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">旧密码</label>
                                    <input type="password" name="password_o" class="form-control" id="exampleInputPassword1" placeholder="请输入你的密码">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">新密码</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请输入你的密码">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">确认密码</label>
                                    <input type="password" name="password_c" class="form-control" id="exampleInputPassword1" placeholder="请再次输入你的密码">
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
        <!-- /.box -->


        <!--/.col (left) -->





        <!-- ./wrapper -->

        @endsection
        @section('js')
            <script type="text/javascript">
                $('#alertError').fadeOut(3000);
            </script>
@endsection