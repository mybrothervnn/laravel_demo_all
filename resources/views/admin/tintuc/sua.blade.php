@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại tin
                    <small>sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">                    	
            	@if(count($errors)>0)
            		@foreach($errors->all() as $err)
            			<div class="alert alert-danger">
            				{{$err}}<br>
            			</div>
            		@endforeach
            	@endif
            	@if(session('thongbao'))
            		<div class="alert alert-success">
            			{{session('thongbao')}}
            		</div>		
            	@endif
                @if(session('loi'))
                    <div class="alert alert-danger">
                        {{session('loi')}}
                    </div>      
                @endif
                <form action="admin/tintuc/postsua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                	<input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <!-- Thể loại  -->
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="idTheLoai" id="TheLoai">
                            @foreach($theloai as $tl)
                                @if($tintuc->loaitin->idTheLoai == $tl->id)
                                    <option selected value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @else
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>   
                    <!-- Loại tin -->
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="idLoaiTin" id="LoaiTin">
                            @foreach($loaitin as $lt)
                                @if($tintuc->idLoaiTin == $lt->id)
                                    <option selected value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @else
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>           
                    <!-- Tiêu đề                 -->
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" />
                    </div>
                    <!-- Tóm tắt -->
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3">{{$tintuc->TomTat}}</textarea>
                    </div>
                    <!-- Nội dung -->
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5">{{$tintuc->NoiDung}}</textarea>
                    </div>
                    <!-- Hình ảnh -->
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <p>
                            <img width="400px" src="upload/tintuc/{{$tintuc->Hinh}}">
                        </p>
                        <input type="file" name="Hinh" class="form-control" value="{{$tintuc->Hinh}}" />
                    </div>           
                    <!-- Nổi bật                 -->
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" 
                            @if($tintuc->NoiBat == 0)
                                checked
                            @endif
                              type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat"  
                            @if($tintuc->NoiBat == 1)
                                checked
                            @endif
                             value="1" type="radio">Có
                        </label>
                    </div>                           
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận
                    <small>Danh sách</small>
                </h1>
            </div>
            @if(session('thongbaocomment'))
                <div class="alert alert-success">
                    {{session('thongbaocomment')}}
                </div>      
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>                        
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc->comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{$cm->id}}</td>
                        <td>{{$cm->user->name}}</td>
                        <td>{{$cm->NoiDung}}</td>                       
                        <td>{{$cm->created_at}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}"> Delete</a></td>
                    </tr>   
                    @endforeach                 
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#TheLoai').change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection