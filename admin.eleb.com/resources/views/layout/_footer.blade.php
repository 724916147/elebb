</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script>
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        //swf: BASE_URL + '/js/Uploader.swf',

        // 文件接收服务端。
        server: '/upload',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        formData:{
            _token:'{{ csrf_token() }}'
        }
    });
    //监听上传成功事件
    uploader.on( 'uploadSuccess', function( file,response ) {
        // do some things.
        console.log(response.path);
        //图片回显
        $("#img").attr('src',response.path);
        //图片地址写入隐藏域
        $("#img_val").val(response.path);
    });
</script>

</body>
</html>