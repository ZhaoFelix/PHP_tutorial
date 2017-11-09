<?php
/*
Cookie保存在客户端中
 * 内存Cookie:由浏览器来维护,保存在内存中,浏览器关闭之后清除cookie
 * 保存在硬盘中的cookie,由用户进行操作
 * 
 * Cookie的使用
 * 永久登录
*/
/*
 * setcookie($name, $value, $expire, $path, $domain, $secure, $httponly)
 *$name:设置cookie的名字
 *$value:设置cookie的值
 *$expire:设置cookie的过期时间,默认是0,单位是秒数
 *$path:设置cookie的有效路径,默认是当前目录及其子目录有效
 *$domain:设置cookie的作用域,默认是在本域下
 *$secure:设置cookie是否通过HTTPS传输,默认是false
 *$httponly:是否只是用访问cookie,使用这个参数可以减少xss的攻击
 * 
*/
setcookie("useNmae", "king1", time()+20);

//setrawcookie不会对值进行URL和encode编码

//通过header的形式设置cookie
//header('Set-Cookie:b=2;expire='. gmdate('D, d M Y H:i:s \G\M\T',time()+10));
//Cookie保存数组形式的数据
setcookie('userinfo[username]','king');

echo '<pre>';
var_dump($_COOKIE);
?>
<script>
    //通过js操作cookie
    var Cookie={
        set:function(key,val,expireDays){
            //判断是否设置expireDays
            if(expireDays){
                var date = new Date();
                date.setTime(date.getTime()+expireDays*24*3600*1000);
                var expireStr="expire="+date.toGMTString()+";";
            }
            else {
                var expireStr = '';
            }
            document.cookie = key+'='+escape(val)+';'+expireStr;
        },
        get:function(key){
            var getCookie = document.cookie.replace(/[ ]/g,'');
            var resArr = getCookie.split(';');
            var res;
            for(var i=0,len=resArr.length;i<len;i++){
                var arr = resArr[i].split('=');
                if(arr[0]==key){
                    res = arr[1];
                    break;
                }
            }
            return unescape(res);
        }
    }
</script>
