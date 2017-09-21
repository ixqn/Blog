@extends('layouts/admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        后台首页
        <small>Welcome To You</small>
      </h1>

    </section>

    <div class="result_wrap">
      <div class="result_title" style="text-align:center;">

        <h3 class="btn btn-block btn-info btn-lg">系统基本信息</h3>
      </div>
      <div class="result_content">
        <ul style="list-style:none;">
          <li>
            <h4><label>操作系统:</label><span>Windows</span></h4>
          </li>
          <li>
            <h4><label>运行环境:</label><span>Apache/2.2.21 PHP/7.1</span></h4>
          </li>
          <li>
            <h4><label>PHP运行方式:</label><span>apache2handler</span></h4>
          </li>


          <li>
            <h4><label>服务器域名/IP:</label><span>{{ config('app.url') }}</span></h4>
          </li>
          <li>
            <h4><label>Host:</label><span>127.0.0.1</span></h4>
          </li>
        </ul>
      </div>
    </div>


    <div class="result_wrap">
      <div class="result_title" style="text-align:center;">

        <h3 class="btn btn-block btn-info btn-lg">使用帮助</h3>
      </div>
      <div class="result_content">
        <ul style="list-style:none;">
          <li>
            <h4><label>官方交流平台：</label><span>北京校区兄弟连</span></h4>
          </li>
          <li>
            <h4><label>官方交流班期：</label><span>PHP188期</span></h4>
          </li>
          <li>
            <h4><label>官方交流小组：</label><span>竹破天小组</span></h4>
          </li>
        </ul>
      </div>
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection