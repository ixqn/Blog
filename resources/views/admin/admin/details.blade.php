@extends('layouts.admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                管理员列表
                <small>admin list</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Data tables</li>
            </ol>
        </section>

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



        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">普通管理</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                <form action="{{url('admin/admin')}}" method="get">
                        <div class="row">
                            <div class="col-md-offset-8 col-md-4">
                                <div class="input-group input-group-sm">
                                    <input name="keywords" type="text" value="{{$input}}" class="form-control">
                                    <span class="input-group-btn">
                                      <button type="submit" class="btn btn-info btn-flat">搜索</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                </form>

                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>头像</th>
                            <th>最后登录时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($admin as $k=>$v)
                            <tr>
                                <td>{{$v->admin_id}}</td>
                                <td>{{$v->nickname}}</td>
                                <td>{{$v->nickname}}</td>

                                {{--<td>{{$v->sex}}</td>--}}
                                <td>
                                    <img src="/admin/uploads/{{$v->picture}}" width="30px" />
                                </td>
                                <td>{{date('Y-m-d H:i:s')}}</td>
                                <td>
                                    <a href="{{url('admin/admin/'.$v->admin_id.'/edit ')}}">
                                        修改
                                    </a>
                                    <a  href="javascript:;" onclick="delAdmin({{$v->admin_id}})">
                                        删除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {!! $admin->appends(['keywords'=>$input])->render() !!}
            </div>
        </div>
        </div>
                    <!-- /.box -->
@endsection
@section('js')
    <script>
        function delAdmin(id)
        {
            layer.confirm('是否确定删除?',{
                btn:['确定','取消']
            },function() {
                $.post('{{url('admin/admin/')}}/' + id, {
                    '_token': '{{csrf_token()}}',
                    '_method': 'delete'
                }, function (data) {
                    if (data.state == 0) {
                        layer.msg(data.msg, {icon: 6});
                        location.href = location.href;
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            },function(){});

        }
    </script>
@endsection
