/**
 * Created by Administrator on 2017/3/21.
 */
function del(url,_token,message) {  //删除数据
    var postData={
        '_method':'delete',
        '_token':_token
    };
    //console.log(postData);
    layer.open({
        type : 0,
        title :'是否提交',
        btn: ['是', '否'],
        icon : 3,
        closeBtn : 2,
        content: "是否确定删除"+message+'?',
        scrollbar: true,
        yes:function(){
            deleteData(url,postData);
        }
    });
}
function deleteData(url,postData)  //删除数据
{
    $.post(url,postData,function(data){
        if(data.status ==0){
            dialog.success(data.msg,data.url);
        }else{
            dialog.error(data.msg);
        }
    });

}

function update(url,_token){   //更新排序
    postData ={'_token':_token};
    var data = $('#form_list').serializeArray();
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    //console.log(url);
    $.post(url,postData,function(data){
        console.log(data);
        if(data.status ==1){
            dialog.success(data.msg,data.url);
        }else{
            dialog.error(data.msg);
        }
    });
}

function add_info(url,_token){  //增加信息
    var postData = {'_token':_token ,'_method':'put'}
    var data=$("#add_table_info").serializeArray();
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    $.post(url,postData, function(data){
        if(data.status ==1){
            dialog.success(data.msg,data.url);
        }else{
            dialog.error(data.msg);
        }
    });
}
