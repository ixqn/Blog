@extends('layouts/admin')
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
                <th>排序</th>
                <th>ID</th>
                <th>分类名称</th>
                <th>分类标题</th>
                <th>查看次数</th>
                <th>图片</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            @foreach($cates as $item)
                <tr>
                    <td>
                        <input onchange="changeOrder(this,{{ $item->cate_id }})" class="btn btn-default" style="width:50px" type="text" name="cate_order" value="{{ $item->cate_order }}">
                    </td>
                    <td>{{ $item->cate_id }}</td>
                    <td class="name">{{ $item->cate_names }}</td>
                    <td>{{ $item->cate_title }}</td>
                    <td>{{ $item->cate_view }}</td>
                    <td><img src="/uploads/{{ $item->cate_pic }}" width="30px"></td>

                    <td><a href="{{ url('/admin/category') }}/{{ $item->cate_id }}/edit">编辑</a> <a href="javascript:;" onclick="delCate({{ $item->cate_id }})">删除</a></td>
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

    <script>
        //改变排序的函数
        function changeOrder(obj,cate_id)
        {
            //获取当前文本框输入的排序值
            var cate_order = $(obj).val();
            $.post('{{ url('admin/category/changeorder') }}',{'_token':'{{ csrf_token() }}','cate_id':cate_id,'cate_order':cate_order},function(data){
                if(data.state == 0){
                    location.href = location.href;
                    layer.msg(data.msg,{icon:5});

                }else{
                    location.href = location.href;
                    layer.msg(data.msg,{icon:6});


                }

            })


        }

        function delCate(id)
        {
            //询问框
            layer.confirm('是否确定删除?', {
                btn: ['确定', '取消']
            },function(){
                $.post('{{url('admin/category/')}}/'+id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
                    if(data.state == 0){
                        layer.msg(data.msg, {icon: 6});
                        location.href = location.href;
                    }else{
                        layer.msg(data.msg, {icon: 5});
                        location.href = location.href;
                    }


                })


            },function(){


            });

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















