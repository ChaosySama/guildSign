
/*
**in:change.php
**to:changeManage.php
**func:提交表单-〉修改管理人员密码
*/
function changemanage(){
    var staffNum=$('#staffNum').val();
    $('#subform').attr("action","changeManage.php");
    $('#subform').submit();
}


/*
**in:change.php
**to:changeStaff.php
**func:提交表单-〉修改公会成员信息
*/
function changestaff(){
    var staffNum=$('#staffNum').val();
    $('#subform').attr("action","changeStaff.php");
    $('#subform').submit();
}


/*
**in:change.php
**func:表单验证（工号）
**func:设置按钮样式&功能
*/
function checkid(){
    var flag;
    var value=$('#staffNum').val();
    if (value == ""){
        layer.tips('不能为空', '#staffNum', {
            tips: [3, '#c00']
        });
        flag=false;
    } else {
        var regu ="^[0-9]{6}$";
        var re = new RegExp(regu);
        if (re.test(value)) {
            flag = true;
        } else {
            layer.tips('请输入6位工号', '#staffNum', {
                tips: [3, '#c00']
            });
            flag = false;
        }
    }
    if(flag==false){
        $('#changemanage').attr("disabled","disabled");
        $('#changemanage').removeAttr("onclick");
        $('#changestaff').attr("disabled","disabled");
        $('#changestaff').removeAttr("onclick");
    }else{
        $('#changemanage').removeAttr("disabled"); 
        $('#changemanage').attr("onclick","changemanage();");
        $('#changestaff').removeAttr("disabled"); 
        $('#changestaff').attr("onclick","changestaff();");
    }
}


/*
**in:changeManage.php
**func:表单验证（密码）
*/
function checkpwnum(s){
    var flag;
    var value=s.value;
    if (value == ""){
        layer.tips('不能为空', s, {
            tips: [3, '#c00']
        });
        flag=false;
    } else {
        var regu ="^[0-9a-zA-Z]{6,}$";
        var re = new RegExp(regu);
        if (re.test(value)) {
            flag = true;
        } else {
            layer.tips('请输入6位以上密码，仅数字和英文', s, {
                tips: [3, '#c00']
            });
            flag = false;
        }
    }
}


/*
**in:changeManage.php
**func:表单验证（密码）
**func:设置按钮样式&功能
*/
function checkpw(){
    var lastPw=$('#lastPw').val();
    var newPw=$('#newPw').val();
    var confirmPw=$('#confirmPw').val();
    if(newPw!=confirmPw){
        layer.msg('两次密码不相同');
        $('#confirmPw').val("");
        $('#subpw').attr("disabled","disabled");
        $('#subpw').removeAttr("onclick");
    }else if(lastPw!="" && confirmPw!="" && newPw==confirmPw){
        $('#subpw').removeAttr("disabled"); 
        $('#subpw').attr("onclick","sentmanage();");
    }
}


/*
**in:addStaff.php & changeStaff.php
**to:staffUpdate.php
**func:json格式传送数据信息
**func:根据返回信息提示用户
*/
function substaff(){
    var num=$('#num').val();
    var name=$('#name').val();
    var sex=$('#sex').val();
    var nation=$('#nation').val();
    var department=$('#department').val();
    var duty=$('#duty').val();
    var fee=$('#fee').val();
    $.post("staffUpdate.php",{num:num,name:name,sex:sex,nation:nation,department:department,duty:duty,fee:fee},function(data){
        switch(data){
            case '0':
                layer.alert('信息修改成功', function(index){
                    layer.close(index);
                    location='change.php';
                });
                break;
            case '1':
                layer.msg("修改失败");
                break;
            case '2':
                layer.alert('人员添加成功', function(index){
                    layer.close(index);
                    location='change.php';
                });
                break;
            case '3':
                layer.msg("添加失败");
                break;
            default:
                layer.msg("未知错误");
        }
    });

}


/*
**in:start.php
**func:表单验证（范围&礼品数）
**func:设置按钮样式&功能
*/
function checkstart(s){
    var range=$('#range').val();
    var giftNum=$('#giftNum').val();
    var thisval=$(s).val();
    if (thisval == ""){
        layer.tips('不能为空', s, {
            tips: [3, '#c00']
        });
        s.focus();
        $('#starte').attr("disabled","disabled");
        $('#starte').removeAttr("type");
    } else {
        var regu ="^[1-9][0-9]{0,}$";
        var re = new RegExp(regu);
        if (!re.test(thisval)) {
            layer.tips('仅整数', s, {
                tips: [3, '#c00']
            });
            s.focus();
            $('#starte').attr("disabled","disabled");
            $('#starte').removeAttr("type");
        }
    }
    var flag=(range!="") && (giftNum!="");
    if(!flag){
        $('#starte').attr("disabled","disabled");
        $('#starte').removeAttr("type");
    }else{
        $('#starte').removeAttr("disabled"); 
        $('#starte').attr("type","submit");
    }
}



/*
**in:addStaff.php & changeStaff.php
**func:表单验证（姓名&民族&会费）
**func:设置按钮样式&功能
*/
function checkinfo(s){
    var num=$('#num').val();
    var name=$('#name').val();
    var sex=$('#sex').val();
    var nation=$('#nation').val();
    var department=$('#department').val();
    var duty=$('#duty').val();
    var fee=$('#fee').val();
    var thisid=$(s).attr("id");
    var thisval=$(s).val();
    switch(thisid){
        case 'name':
            if (thisval == ""){
                layer.tips('不能为空', s, {
                    tips: [3, '#c00']
                });
                s.focus();
                $('#substaff').attr("disabled","disabled");
                $('#substaff').removeAttr("onclick");
            } else {
                var regu ="^[a-zA-Z\u4e00-\u9fa5]{2,}$";
                var re = new RegExp(regu);
                if (!re.test(thisval)) {
                    layer.tips('仅英文或汉字', s, {
                        tips: [3, '#c00']
                    });
                    s.focus();
                    $('#substaff').attr("disabled","disabled");
                    $('#substaff').removeAttr("onclick");
                }
            }
            break;
        case 'nation':
            if (thisval == ""){
                layer.tips('不能为空', s, {
                    tips: [3, '#c00']
                });
                s.focus();
                $('#substaff').attr("disabled","disabled");
                $('#substaff').removeAttr("onclick");
            } else {
                var regu ="^[\u4e00-\u9fa5]{1,}$";
                var re = new RegExp(regu);
                if (!re.test(thisval)) {
                    layer.tips('仅汉字', s, {
                        tips: [3, '#c00']
                    });
                    s.focus();
                    $('#substaff').attr("disabled","disabled");
                    $('#substaff').removeAttr("onclick");
                }
            }
            break;
        case 'fee':
            if (thisval == ""){
                layer.tips('不能为空', s, {
                    tips: [3, '#c00']
                });
                s.focus();
                $('#substaff').attr("disabled","disabled");
                $('#substaff').removeAttr("onclick");
            } else {
                var regu ="^[1-9][0-9]{0,}$";
                var re = new RegExp(regu);
                if (!re.test(thisval)) {
                    layer.tips('仅整数', s, {
                        tips: [3, '#c00']
                    });
                    s.focus();
                    $('#substaff').attr("disabled","disabled");
                    $('#substaff').removeAttr("onclick");
                }
            }
            break;
        default:
            layer.msg("未知错误");
    }
    var flag=(num!="") && (name!="") && (sex!="") && (nation!="") && (department!="") && (duty!="") && (fee!="");
    if(!flag){
        $('#substaff').attr("disabled","disabled");
        $('#substaff').removeAttr("onclick");
    }else{
        $('#substaff').removeAttr("disabled"); 
        $('#substaff').attr("onclick","substaff();");
    }
}



/*
**in:addStaff.php
**to:checknew.php
**func:数据库验证（工号）
**func:根据返回值清空工号
*/
function checknum(){
    var num=$('#num').val();
    $.post("checknew.php",{num:num},function(data){
        if(data=='0'){
            layer.msg('改工号已存在');
            $('#num').val("");
        }
    });
}


/*
**in:changeManage.php
**to:manageUpdate.php
**func:json格式传送数据信息
**func:根据返回值清空密码or提示用户
*/
function sentmanage(){
    var confirmPw=$('#confirmPw').val();
    var lastPw=$('#lastPw').val();
    var num=$('#num').val();
    $.post("manageUpdate.php",{num:num,lastPw:lastPw,confirmPw:confirmPw},function(data){
        switch(data){
            case '0':
                layer.msg('原密码不正确');
                $('#confirmPw').val("");
                $('#lastPw').val("");
                $('#newPw').val("");
                break;
            case '1':
                layer.msg("输入的密码和原密码相同");
                $('#confirmPw').val("");
                $('#lastPw').val("");
                $('#newPw').val("");
                break;
            case '2':
                layer.alert('密码修改成功,请重新登陆', function(index){
                    layer.close(index);
                    location='manage.html';
                });
                break;
            default:
                layer.msg("未知错误");
        }
    });
}


/*
**in:except main.php *.html
**to:fresh.php
**func:获取json格式数据信息解析
**func:更新状态栏信息
*/
function fresh(){
    $.post("fresh.php",{},function(data){
        var obj = eval("(" + data + ")");
        $('#Qnum').text(obj.number);
        $('#Gnum').text(obj.giftnum);
        $('#aT').text(obj.aT);
        $('#oT').text(obj.oT);
        $('#nT').text(obj.nT);
        var Aflag=obj.Aflag;
        if(Aflag==1){
            $('#Aflag').text("Active");
            $("#Aflag").css("color","green");
        } else if(Aflag==0){
            $('#Aflag').text("Stopped");
            $("#Aflag").css("color","red");
        } else if(Aflag==2){
            $('#Aflag').text("Overtime");
            $("#Aflag").css("color","orange");
        }
    });
}


/*
**in:main.php
**to:stop.php
**func:停止活动&修改相关表信息&清除相关SESSION
**func:提示活动结束&跳转
*/
function stopevent(){
    $.post("stop.php",{},function(data){
        layer.alert('活动已成功结束', function(index){
            layer.close(index);
            location='main.php';
        });
    });
}


/*
**in:gift.php
**to:getgift.php
**func:json格式传送数据信息
**func:根据返回信息提示用户&清空输入框
*/
function getgiftbycode(){
    var idcode=$('#idCode').val();
    var idcodeflag=0;
    $.post("getgift.php",{idcodeflag:idcodeflag,idcode:idcode,},function(data){
        switch(data){
            case '0':
                layer.msg('活动未开始');
                break;
            case '1':
                layer.msg("验证成功，请领取礼品");
                break;
            case '2':
                layer.msg("验证成功，礼品数量不足，稍后补发");
                break;
            case '3':
                layer.msg("未签到");
                break;
            case '4':
                layer.msg("不存在的工号");
                break;
            case '5':
                layer.msg("验证码错误");
                break;
            case '6':
                layer.msg("请勿重复签到");
                break;
            default:
                layer.msg("未知错误");
        }
        $('#idCode').val("");
    });
}


/*
**in:gift.php
**to:getgift.php
**func:json格式传送数据信息
**func:根据返回信息提示用户&清空输入框
*/
function getgiftbyid(){
    var idcode=$('#staffNum').val();
    var idcodeflag=1;
    $.post("getgift.php",{idcodeflag:idcodeflag,idcode:idcode,},function(data){
        switch(data){
            case '0':
                layer.msg("活动未开始");
                break;
            case '1':
                layer.msg("验证成功，请领取礼品");
                break;
            case '2':
                layer.msg("验证成功，礼品数量不足，稍后补发");
                break;
            case '3':
                layer.msg("未签到");
                break;
            case '4':
                layer.msg("不存在的工号");
                break;
            case '5':
                layer.msg("验证码错误");
                break;
            case '6':
                layer.msg("请勿重复签到");
                break;
            default:
                layer.msg("未知错误");
        }
        $('#staffNum').val("");
    });
}


/*
**in:index.html
**func:设置cookie
**func:判断已存在cookie是否相同
*/
function setcookie(time){
    var Id=$('#userNumber').val();
    var cookieid=$.cookie("id");
    if(cookieid){
        if(cookieid==Id){
            return true;
        }else {
            layer.msg("请勿带签到");
            return false;
        }
    }else {
        var date=new Date();
        date.setTime(date.getTime()+(time*60*1000));//30min
        $.cookie("id",Id,{ expires: date});
        return true;
    }
}

/*
//删除cookie方法
function delcookie(){
    $.cookie("id", '', { expires: -1 }); 
    alert("del success");
}

*/
