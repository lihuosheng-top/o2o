/**
 * Created by lihuosheng on 2017/10/16.
 */

$(function () {
    $('#file_upload').uploadify({
        'swf': SCOPE.uploadify_swf_url,
        'uploader': SCOPE.upload_image_url,
        'buttonText': '上传图片',
        'fileTypeDesc': 'Image Files',
        'fileTypeExts': '*.jpg;*.png;*.gif;*.jpeg',
        'fileObjName': 'file',
        'onUploadSuccess': function (file, datas, response) {
            // console.log(file);
            // console.log(datas);
            // console.log(response);

            if(response)
            {
                //转化data类型
                var obj =JSON.parse(datas);
                //这个data是值付上,连调用
                $('#upload_org_code_img').attr('src',obj.data).show();
//将图片路径赋值给一个隐藏的input,方便将来表单提交(能把表单中value带走)
                $('#file_upload_image').attr('value',obj.data);

            }

        }
    })

});

$(function () {
    $('#file_upload_other').uploadify({
        'swf': SCOPE.uploadify_swf_url,
        'uploader': SCOPE.upload_image_url,
        'buttonText': '上传图片',
        'fileTypeDesc': 'Image Files',
        'fileTypeExts': '*.jpg;*.png;*.gif;*.jpeg',
        'fileObjName': 'file',
        'onUploadSuccess': function (file, datas, response) {
            // console.log(file);
            // console.log(datas);
            // console.log(response);

            if(response)
            {
                //转化data类型
                var obj =JSON.parse(datas);
                //这个data是值付上,连调用
                $('#upload_org_code_img_other').attr('src',obj.data).show();
//将图片路径赋值给一个隐藏的input,方便将来表单提交(能把表单中value带走)
                $('#file_upload_image_other').attr('value',obj.data);

            }

        }
    })

});
