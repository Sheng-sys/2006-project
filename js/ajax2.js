var f = document.forms[0]

f.addEventListener('submit',function(ev){
   ev.preventDefault()

   var inputs = f.getElementsByTagName('input')
   
   var send_str = ""
   for(var i=0;i<inputs.length;i++){
     
     if(inputs[i].getAttribute('name') == null){
         continue
     }
      var k = inputs[i].getAttribute('name')
      var v = inputs[i].value
    
      send_str += k + "=" + v + "&" 
   }

    new_str = send_str.substring(0,send_str.length-1)

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json_str = xhr.responseText
            var data = JSON.parse(json_str)
            if(data.errno == 0){
                alert('注册成功')
                window.location.href = 'ajax3.html'
            }else{
                alert(data.mgs)
            }
        }
    }

   xhr.open('POST','ajax2.php')

   xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")

   xhr.send(new_str)
})