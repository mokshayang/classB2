<div>
<div>請輸入信箱以查詢密碼</div>
<div><input type="text" name="email" id="email"></div>
<div id="result"></div>
<div><button onclick="forgot()">找尋</button></div>

</div>
<script>
    function forgot(){
        console.log(123);
        $.get("./api/forgot.php",{email:$("#email").val()},(result)=>{
            $('#result').html(result);
        })
    }

</script>