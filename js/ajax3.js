var f = document.forms[0]

f.addEventListener('submit',function(ev){
    ev.preventDefault()
    var input = f.getElementsByTagName('input')

        var send_str = ""

        for(var i=0;i<input.length;i++){
            if(input[i].getAttribute('name') == null){
                continue
            }

            var k = input[i].getAttribute('name')
            // console.log(k)
            var v = input[i].value

            send_str += k + '=' + v + '&'
        }
            send_str = send_str.substring(0,send_str.length-1)

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(xhr.readyState === 4 && xhr.status === 200){
                    var json_str = xhr.responseText
                    var data = JSON.parse(json_str)
                    if(data.errno == 0){
                        alert('登录成功')
                        window.location.href = 'jiudian.php'
                    }else{
                        alert(data.mgs)
                    }
                }
            }

        xhr.open('POST','ajax3.php')

        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")

        xhr.send(send_str)
})
