@extends('layouts/admin')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                文章列表
                <small>文章管理</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                <li><a href="#">文章管理</a></li>
                <li class="active">文章列表</li>
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



        <button type="submit" class="btn btn-default"><a href="{{ url('admin/article') }}">全部</a></button>
        <form action="{{ url('/admin/article') }}" method="get">
            <div class="row">


                <div class="col-md-offset-8 col-md-4">
                    <div class="input-group input-group">
                        <input name="keywords" type="text" class="form-control" value="
						@if(!empty($request['keywords']))
                        {{ $request['keywords'] }}
                        @endif
                                ">
                        <span class="input-group-btn">
		                      <button type="submit" class="btn btn-info btn-flat">搜索!</button>
		                    </span>
                    </div>


                </div>

            </div>
        </form>




        <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th style="width:50px">ID</th>
                <th style="width:300px">文章名称</th>
                <th style="width:100px">分类名称</th>
                <th style="width:100px">文章作者</th>
                <th style="width:50px">看次</th>
                <th style="width:150px">添加时间</th>
                <th style="width:70px">状态</th>
                <th style="width:200px">操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $item)

                <tr>
                    <td style="text-align:center">{{ $item->article_id }}</td>
                    <td><a href="{{url('admin/article/cont')}}/{{ $item->article_id }}">{{ $item->article_name }}</a></td>
                    <td>{{ $item->cate_name }}</td>
                    <td>{{ $item->article_author }}</td>
                    <td>{{ $item->article_view }}</td>
                    <td>{{ $item->article_at }}</td>
                    <td>
                        @if( $item->article_status == 1)
                        未发布
                        @elseif( $item->article_status == 2)
                        已发布
                        @endif

                    </td>
                    <td style="text-align:center">
                        <a href="javascript:;" onclick="show({{ $item->article_id }})">
                            @if( $item->article_status == 1)

                                <button type="submit" class="btn btn-default" style="color:mediumvioletred">等待发布</button>
                                <button type="submit" class="btn btn-default" disabled="disabled">取消发布</button>
                            @elseif( $item->article_status == 2)
                                <button type="submit" class="btn btn-default" disabled="disabled" style="color:mediumvioletred">等待发布</button>
                                <button type="submit" class="btn btn-default">取消发布</button>
                            @endif
                        </a>
                    </td>
                </tr>


            @endforeach


            </tbody>
        </table>
        {!! $users->links() !!}

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
    <script>
        function show(id)
        {

                $.post('{{url('admin/article/show')}}/'+id,{'_token':'{{csrf_token()}}'},function(data){
                    if(data.state == 0){
                        location.href = location.href;
                        layer.msg(data.msg,{icon:5});

                    }else{
                        location.href = location.href;
                        layer.msg(data.msg,{icon:6});


                    }

                })





        }


    </script>




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















