@extends('layouts/admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                分类管理
                <small>分类添加</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                <li><a href="#">分类管理</a></li>
                <li class="active">分类添加</li>
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
                            <h3 class="box-title">快速添加分类</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <form role="form" action="{{ url('/admin/category/'.$cates->cate_id) }}" method="post" enctype="multipart/form-data">

                            {{ method_field('PUT') }}

                            @if (count($errors) > 0)
                                <div id="alertError" class="alert alert-danger">
                                    <ul style="color:cyan">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(!empty(session('errors')))
                                <div class="mark">
                                    <p>{{session('errors')}}</p>

                                </div>


                            @endif



                            {{ csrf_field() }}

                            <div class="box-body">
                                <div class="form-group">
                                    <label>父分类</label>
                                    <select name="cate_pid" class="form-control">
                                        <option value="0">==顶级分类==</option>
                                        @foreach($data as $v)
                                            <option value="{{ $v->cate_id }}">{{ $v->cate_names }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">分类名:</label>
                                    <input type="text" name="cate_name" class="form-control" id="exampleInputEmail1" value="{{ $cates->cate_name  }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">标题:</label>
                                    <input type="text" name="cate_title" class="form-control" id="exampleInputEmail1" value="{{ $cates->cate_title  }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">关键词:</label>
                                    <textarea class="form-control" row="3" name="cate_keywords">{{ $cates->cate_keywords  }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">描述:</label>
                                    <textarea class="form-control" row="5" name="cate_description">{{ $cates->cate_description  }}</textarea>
                                </div>
                                <div>
                                    <label for="exampleInputEmail1">图片:</label>
                                    <input type="file" name="cate_pic" class="form-control">

                                </div>
                                <div class="col-xs-5">
                                    <label for="exampleInputEmail1">排序:</label>
                                    <input type="text" name="cate_order" class="form-control" value="{{ $cates->cate_order  }}">
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@stop

@section('js')
    <script type="text/javascript">
        $("#alertError").hide(3000);
    </script>
@stop
