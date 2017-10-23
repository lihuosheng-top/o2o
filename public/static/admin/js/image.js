/**
 * Created by lihuosheng on 2017/10/17.
 */


//TODO:上传图片的缩略图的js
$(function () {
    //根据所列图的Id获取,jQuery上传插件uploadify
    $('#file_upload').uploadify({

        'swf': SCOPE.uploadify_swf_url,
        'uploader': SCOPE.upload_image_url,
        'buttonText': '上传图片',
        'fileTypeDesc': 'Image Files',
        'fileTypeExts': '*.gif;*.jpg;*.png',
        'fileObjName': 'file',
        'onUploadSuccess': function (file, datas, response) {

            if (response) {
                //转化为data类型
                //TODO:JSON.parse用于从一个字符串中解析出json对象,如
                var obj = JSON.parse(datas);

                //这个data是值附上,连调用show()方法,attr()方法设置或返回被选元素的属性值。
                $('#upload_org_code_img').attr('src', obj.data).show();

                //将图片路径赋值给一个隐藏的input,方便将来表单提交(能把表单中的value带走)
                $('#file_upload_image').attr('value', obj.data);
            }
        }
    })
});

//TODO:营业执照的上传图片

$(function () {
    $('#file_upload_other').uploadify({
        'swf':SCOPE.uploadify_swf_url,
        'uploader':SCOPE.upload_image_url,
        'fileTypeDesc': 'Image Files',
        'buttonText':'上传图片',
        'fileTypeExts':'*.gif;*.jpg;*.png',
        'fileObjName':'file',
        'onUploadSuccess':function (file,datas,response) {
//返回的数据服务器端脚本(任何回应的文件)
            if(response)
            {
                //转化为data类型
                var obj =JSON.parse(datas);
                //这个data是值付上,连调用,show()放大,attr方法设置或返回被选元素的属性值
                $('#upload_org_code_img_other').attr('src',obj.data).show();
                //将图片路劲赋值给一个隐藏的input,方便将来表单的提交,并能把表单中的value带走
                $('#file_upload_image_other').attr('value',obj.data);
            }
        }

    });
});
