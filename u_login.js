var f = document.forms[0]
// console.log(f)
f.addEventListener('submit',function(ev){
    ev.preventDefault()

    var inputs = f.getElementsByTagName('input')
    var str = ""
    for(var i=0;i<inputs.length;i++){
        if(inputs[i].getAttribute('name') == null){
            continue
        }
        var k = inputs[i].getAttribute('name')
        var v = inputs[i].value

        str += k + '=' + v +'&'
    }
        var new_str = str.substring(0,str.length-1) 
        // console.log(new_str)


    var xhr = new XMLHttpRequest
    xhr.onreadystatechange = function(){
        if(xhr.readyState == xhr.DONE && xhr.status == 200){
            var json_str = xhr.responseText
            // console.log(json_str)
            var data = JSON.parse(json_str)
            // console.log(data)
            if(data.errno == 0){
                alert('登录成功')
                document.cookie = 'name' + '=' + data.name + '&' + 'pwd' + '=' + data.pwd
                alert(document.cookie)
                window.location.href = 'jiudian.php'
            }else{
                alert(data.mgs)
            }
        }
    }
    
    xhr.open('POST','u_login.php')
    
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    
    xhr.send(new_str)
})