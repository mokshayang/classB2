<fieldset>
    <legend>帳號管理</legend>
<form action="./api/del_acc.php" method="post">
<?php
$rows=$User->all();
?>
<table style="margin:auto; width:80%;">
    <tr>
        <td>帳號</td>
        <td>密碼</td>
        <td>刪除</td>
    </tr>
    <?php 
    foreach ($rows as  $row) {  # code...
    ?>
    <tr>
        <td><?=$row['acc']?></td>
        <td><?=str_replace(" ","*", strlen($row['pw']) )?></td>
        <td><input type="checkbox" name="del[]" value="<?=$row['id']?>" ></td>
    </tr>
    <?php } ?>
</table>
<div class="ct">
    <input type="submit" value="確定刪除">
    <input type="reset" value="清空選取">
</div>



</form>


    <h2>新增會員</h2>
    <div style="color:red">
        *請設定你要註冊的帳號及密碼(最長12個字元)
    </div>
    <table>
        <tr>
            <td>Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td>Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button>
                <button onclick="reset()">清除</button>
            </td>
            <td></td>
        </tr>
    </table>


</fieldset>
<script>
    function reset() {
        $('#acc,#pw,#pw2,#email').val("");
    }

    function reg() {
        let user = {
            acc: $('#acc').val(),
            pw: $('#pw').val(),
            pw2: $('#pw2').val(),
            email: $('#email').val(),
        }
        // 檢查是否有空白
        if (user.acc == '' || user.pw == '' || user.pw2 == '' || user.email == '') {
            //有空白
            alert('不可空白');
        } else {
            //沒空白
            // 密碼是否相同
            if (user.pw == user.pw2) {

                //檢查帳號是否重複
                $.post("./api/chk_acc.php", user, (result) => {

                    if (parseInt(result) === 1) {
                        //重複
                        alert("帳號重複");
                    } else {
                        console.log("123");
                        $.post("./api/reg.php", user, () => { //送去api填入資料庫

                            alert("註冊完成，歡迎加入");
                            reset();
                        })

                        //alert("註冊完成，歡迎加入");
                        //放這的話，可能ajax還沒跑完 就跳出來了，所以要放上面

                    }

                })


            } else {
                alert("密碼錯誤")
            }

        }


    }
</script>