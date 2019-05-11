@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại tin
                            <small>thêm</small>
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
                        <form action="admin/tintuc/postthem" method="POST" enctype="multipart/form-data">
                        	<input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <!-- Thể loại  -->
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="idTheLoai" id="TheLoai">
                                    @foreach($theloai as $tl)
                                        <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>   
                            <!-- Loại tin -->
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="idLoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $lt)
                                        <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>           
                            <!-- Tiêu đề                 -->
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Hãy nhập tiêu đề" />
                            </div>
                            <!-- Tóm tắt -->
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                            <!-- Nội dung -->
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5"></textarea>
                            </div>
                            <!-- Hình ảnh -->
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control" />
                            </div>           
                            <!-- Nổi bật                 -->
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio">Có
                                </label>
                            </div>                           
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
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