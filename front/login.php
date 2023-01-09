<!--  -->
<fieldset style="width:fit-content; margin:auto;">
    <legend>會員登入</legend>
    <div>帳號 :
        <input type="text" name="acc" id="acc">
    </div>
    <div>密碼 :
        <input type="password" name="pw" id="pw">
    </div>

    <div style="margin-top: 20px;">
        <span>
            <!-- <input type="submit" value="登入"> -->
            <!-- <input type="reset" value="清除"> -->
            <button onclick="login()" > 登入 </button>
            <button onclick="reset()" > 清除 </button>
        </span>&nbsp;&nbsp;&nbsp;&nbsp;
        <span>
            <a href="?do=forgot">忘記密碼</a> |
            <a href="?do=reg">尚未註冊</a>
        </span>
    </div>
</fieldset>

<script>
    
function reset(){
    $('#acc,#pw').val("");
}
function login(){
    let user = {
        'acc' : $('#acc').val(),
        'pw' : $('#pw').val()
    }
    // console.log(user);
    //ajax
    $.post("./api/chk.php".user,(result)=>{
        if(parseInt(result)===1){   //parseInt 解析為數字 需用3個 === 辦別型別
            
        }else{

            alert('查無帳號');
        }
    })
}
</script>