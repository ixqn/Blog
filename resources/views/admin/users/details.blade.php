@extends('layouts/admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                前端用户列表
                <small>advanced tables</small>
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

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Hover Data Table</h3>
                        </div>


                        <form action="{{url('admin/users')}}" method="get">
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

                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>头像</th>
                                    <th>生日</th>
                                    <th>邮箱</th>
                                    <th>最后修改时间</th>
                                    <th>注册时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $k=>$v)
                                    <tr>
                                        <td>{{$v->user_id}}</td>
                                        <td>{{$v->nickname}}</td>
                                        <td>{{$v->sex}}</td>
                                        <td>
                                            <img src="/admin/uploads/{{$v->pic}}" width="30px" />
                                        </td>
                                        <td>{{$v->birthday}}</td>
                                        <td>{{$v->email}}</td>
                                        <td>{{$v->created_at}}</td>
                                        <td>{{$v->updated_at}}</td>
                                        <td>
                                            <a href="{{url('admin/users/'.$v->user_id.'/edit ')}}">
                                                修改
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>头像</th>
                                    <th>生日</th>
                                    <th>邮箱</th>
                                    <th>最后修改时间</th>
                                    <th>注册时间</th>
                                    <th>操作</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                {!! $users->appends(['keywords'=>$input])->render() !!}
            </div>
        </section>
    </div>

@endsection
@section('js')

    <script type="text/javascript">
        $('#alertError').fadeOut(2000);
    </script>
@endsection