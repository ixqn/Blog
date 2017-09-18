@extends('admin.layout')


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                举报管理
                <small>举报文章</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                <li><a href="#">举报管理</a></li>
                <li class="active">举报文章</li>
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
                            <h3 class="box-title">快速查看</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->


                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>文章名称</th>
                                    <th>举报原因</th>
                                    <th>举报内容</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($datas as $item)

                                    <tr>
                                        <td>{{ $item->id }}</td>

                                        <td>{{ $item->comm_cont }}</td>

                                        <td>{{ $item->inf_cause }}</td>
                                        <td>{{ $item->inf_content }}</td>

                                        <td><a href="javascript:;" onclick="discomment({{ $item->id }})">
                                                @if( $item->status == 0)
                                                    <p style="color:#ff00ff">未处理</p>
                                                @elseif( $item->status == 1)
                                                    已处理
                                                @endif
                                            </a></td>

                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                            <!-- /.box-body -->
                            {!! $datas->links() !!}
                            {{--<div class="box-footer">--}}
                            {{--<button type="submit" class="btn btn-primary">更新</button>--}}
                            {{--</div>--}}

                        </div>





                        <!-- /.box-body -->

                        {{--<div class="box-footer">--}}
                        {{--<button type="submit" class="btn btn-primary">更新</button>--}}
                        {{--</div>--}}

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

    <script type="text/javascript">
            function discomment(id)
            {
                $.post('{{ url('/admin/inf/discom') }}/'+id,{'_token':'{{ csrf_token() }}'},function(data){

                    location.href = location.href;


                })



            }



    </script>

@stop

@section('js')
    <script type="text/javascript">
        $("#alertError").hide(3000);
    </script>
@stop
