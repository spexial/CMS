@extends('layouts.admin.app')
@section('content')
    <div class=" col-md-offset-2 admin-article">
        <div class="portlet-title"><strong>新增文章</strong></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/admin/article/save" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group-body">
                <div class="col-md-10 group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label class="col-md-2 control-label">标题<span class="required">*</span></label>
                    <div class="col-md-10">
                        <div class="input-icon">
                            <input type="text" name="title" class="form-control" value=""
                                   placeholder="请输入标题">
                        </div>
                    </div>
                </div>
                <div class="col-md-10 group">
                    <label class="col-md-2 control-label">分类<span class="required">*</span></label>
                    <div class="col-md-10">
                        <select name="type" class="form-control">
                            @foreach($articleTypes as $articleType)
                                <option value="{{$articleType->id}}">{{$articleType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-10 group">
                    <label class="col-md-2 control-label">关键词</label>
                    <div class="col-md-10">
                        <div class="input-icon">
                            <input type="text" name="keywords" class="form-control" value=""
                                   placeholder="请输入关键词">
                        </div>
                    </div>
                </div>
                <div class="col-md-10 group">
                    <label class="col-md-2 control-label">简介</label>
                    <div class="col-md-10">
                        <div class="input-icon">
                            <input type="text" name="description" class="form-control" value=""
                                   placeholder="请输入简介">
                        </div>
                    </div>
                </div>
                <div class="col-md-10 group">
                    <label class="control-label col-md-2">缩略图<span class="required">* </span></label>

                    <div class="col-md-5">
                        <input type="file" name="image" />
                    </div>
                </div>
                {{--<div class="col-md-10 group">--}}
                    {{--<label class="control-label col-md-2">图集</label>--}}
                    {{--<input type="images" value="上传图片" class="button_div_left" id="file_upload">--}}

                    {{--<div class="pic-group hx">--}}
                        {{--<div class="clear"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-md-10 group">
                    {{--<div class="col-md-12">--}}
                         <script id="container" name="content" type="text/plain"></script>
                    {{--</div>--}}
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class=" col-md-12 setting-button" >
                        <button type="submit" class="btn green">提交</button>
                    </div>

                </div>
            </div>
        </form>
    </div>




    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>
    <!--多图上传-->
    <script>
        $(function () {
            /**
             *  判断是否存在图片
             */
            $(".pic-group").each(function () {
                if ($(this).find('').length) {
                    $(this).css('display', 'block');
                }
            });

            $("#file_upload").uploadify({
                'formData': {
                    'timestamp': '<?php echo time()?>',
                    'token': '<?php echo md5('unique_salt' .time())?>'
                },
                'width': 149,
                'height': 38,
                'fileSizeLimit': '3072KB',
                'buttonClass': 'uploadify-button',
                'buttonText': '',
                'swf': '/js/uploadify.swf',
                'uploader': '/js/uploadify.php',
                'checkExisting': '/js/check-exists.php',
                'debug': false,
                'onUploadStart': function (file) {

                    var hx = $(".hx").find(".pic_1").length;
                    if (parseInt(hx) >= 6) {
                        alert('最多只能上传6个');
                        $('#file_upload').uploadify('cancel', file.id);
                    }
                },

                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    if (errorString != 'Cancelled') {
                        alert('图片上传出错了');
                    }
                    //alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                },
                'onUploadSuccess': function (file, data, response) {
                    if (data.length > 50 || data == '') {
                        console.log(data);
                        alert('上传失败');
                        return;
                    }
                    var imgList = '';
                    imgList += '<div class="pic_1" style="float:left;">' +
                            '<img width="100" height="100" src="/uploads/'+ data +'" style="display:block;" />' +
                            '<div class="biaoti"></div>' +
                            '<div class="aa">' +
                            '<a href="javascript:void(0);" onclick="deleteItemImage( this);" title="删除">删除</a>' +
                            '</div>' +
                            '<div class="describe-input">' +
                            '<input type="hidden" name="real_name[]" value="' + file.name + '" />' +
                            '<input type="hidden" name="pic_ids[]" value="0" />' +
                            '<input type="hidden" name="pic_url[]" value="/uploads/' + data + '" />' +
                            '</div>' +
                            '</div>';
                    $('.pic-group').find('div.clear').before(imgList);
                }

            });
        });
        /**
         * 设置删除
         * item
         */
        function deleteItemImage(item) {
            $(item).parent().parent().remove();
        }
        /**
         * 设置默认值
         *  item
         */
        function setDefaultFace(item) {
            $(".aa").find("input").val(0);
            $(item).parents('.aa').find('input').val(1);
        }
    </script>
@endsection
