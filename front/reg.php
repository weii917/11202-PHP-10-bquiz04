<h2 class="ct">會員註冊</h2>
<table class="all">
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name"></td>
    </tr>
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp">
            <input type="text" name="acc" id="acc">
            <button onclick="chkacc()">檢測帳號</button>
        </td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">電話</td>
        <td class="pp"><input type="text" name="tel" id="tel"></td>
    </tr>
    <tr>
        <td class="tt ct">住址</td>
        <td class="pp"><input type="text" name="addr" id="addr"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email"></td>
    </tr>
</table>
<div class="ct">
    <button onclick="reg()">註冊</button>
    <button onclick="clean()">重置</button>
</div>
<!-- 檢測帳號的function ， 將acc的value送到api撈出資料庫計算筆數，echo的結果回到res，在此做判斷==1代表與資料庫有符合一筆帳號 -->
<script>
    function reg() {
        let user = {
            name: $("#name").val(),
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            tel: $("#tel").val(),
            addr: $("#addr").val(),
            email: $("#email").val(),
        }
        $.get("./api/chk_acc.php", {
            acc: user.acc
        }, (res) => {
            if (parseInt(res) == 1 || user.acc == 'admin') {
                alert(`此帳號${user.acc}已被使用`)
            } else {
                $.post("./api/reg.php", user, () => {
                    alert("註冊成功，歡迎加入")
                    location.href = '?do=login'
                })

            }
        })
    }
    // 因為用ajax不知道e結果什麼時候回來，所以無法chkacc()直接呼叫取用來判斷，從這裡直接複製一個在註冊前做判斷是否帳號已使用
    function chkacc() {
        let acc = $("#acc").val()
        $.get("./api/chk_acc.php", {
            acc
        }, (res) => {
            if (parseInt(res) == 1 || acc == 'admin') {
                alert(`此帳號${acc}已被使用`)
            } else {
                alert(`此帳號${acc}可以使用`)

            }
        })
    }

    function clean() {
        $("#name,#acc,#pw,#tel,#addr,#email").val('');
    }
</script>