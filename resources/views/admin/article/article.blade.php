@extends('admin.layout')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                分类列表
                <small>分类管理</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                <li><a href="#">分类管理</a></li>
                <li class="active">分类列表</li>
            </ol>
        </section>

        <!-- Main content -->

        @if(session('info'))
            <div id="alertError" class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban">错误!</i></h4>
                {{ session('info') }}

            </div>

        @endif


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul style="color:cyan">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif







        <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th style="width:300px">文章名称 (可点击查看文章内容)</th>
                <th style="width:100px">分类名称</th>
                <th style="width:100px">文章作者</th>
                <th style="width:150px">添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $item)

                <tr>
                    <td>{{ $item->article_id }}</td>
                    <td><a href="{{url('admin/article/cont')}}/{{ $item->article_id }}">{{ $item->article_name }}</a></td>
                    <td>{{ $item->cate_name }}</td>
                    <td>{{ $item->article_author }}</td>
                    <td>{{ $item->article_at }}</td>

                    {{--<td> <a href="javascript:;" onclick="()">删除</a></td>--}}
                </tr>


            @endforeach


            </tbody>
        </table>


    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->





@stop


@section('js')

    <script type="text/javascript">

        $("#alertError").fadeOut(3000);

        function del(id)
        {
            $('#delForm').attr("action",'/admin/category/'+ id);
            $("#delForm").submit();
        }

    </script>

@stop















