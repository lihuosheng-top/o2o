/**
 * Created by lihuosheng on 2017/10/12.
 */
/*页面 全屏-添加*/
function o2o_edit(title, url) {
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}

/*添加或者编辑缩小的屏幕*/
function o2o_s_edit(title, url, w, h) {
    layer_show(title, url, w, h);
}
/*-删除*/
function o2o_del(id, url) {

    layer.confirm('确认要删除吗？', function (index) {
        window.location.href = url;
    });
}

//TODO:排序触发的blur事件

$(".listorder input").blur(function () {
    //获取attr-id的属性值
    var id = $(this).attr('attr-id');
    //获取当前input的值
    var listorder = $(this).val();

    var postData = {

        id: id,
        listorder: listorder
    };

    console.log(postData);

    //设置发送的地址:

    var url = SCOPE.listorder_url;

    console.log(url);
    //执行ajax请求
    $.post(url, postData, function (result) {
        //接收

        console.log(result);

        if (result.code == 1) {
            window.location.href = result.data;
        }

    }, 'JSON');

});


//TODO:获取二级IDchange方法
//当元素的值发生改变时，会发生 change 事件。
$(".cityId").change(function () {
    var id = $(this).val();
    var posiData = {
        id: id
    };
    var url = SCOPE.city_second_url;
    $.post(url, posiData, function (result) {
        if (result.code === 1) {
            var data = result.data;
            //根据数据重新组合新的<option>循环
            var cityHtml = '';
            $(data).each(function () {
                cityHtml += "<option value=" + this.id + ">" + this.name + "</option>>"
            })
            //写入到定位位置
            $(".se_city_id").html(cityHtml);
        }
    }, 'JSON');
});

//TODO:获取分类二级子栏目
//获取分类信息的二级子栏目,例如:获取点击美食,显示'火锅,过把肉';

$('.categoryId').change(function () {
   //获取当前id作为查询的条件parent_id
    var id=$(this).val();
    var posiData={
      id:id
};

    var url =SCOPE.category_second_url;

    $.post(url,posiData,function (res) {
       if(res.code==1)
       {
           var data =res.data;
           //根据数据
           console.log(data);
           var categoryHtml='';
           $(data).each(function () {
              categoryHtml +="<input type='checkbox' name='se_category_id[]' value='" +this.id + "'>";
              categoryHtml +="<label>"+this.name+"</label>"
           });
           $(".se_category_id").html(categoryHtml);
       }
       if(res.code==0)
       {

           $(".se_category_id").html('');
       }


    },'JSON');
});






