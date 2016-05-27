<?php
session_start();

$msg_array = array("name1" => "", "name2" => "", "tel" => "", "email" => "" ,"text" => "");
$err_msg = array("未入力です", "半角数字のみで入力してください", "形式が違います");
$flag = 1;
if(isset($_POST['reset'])){
    $_POST = array();
}


if(count($_POST) != 0){
    //バリデーション
    if($_POST['name1'] == ""){
        $msg_array['name1'] = $err_msg[0];
        $flag = 0;
    }

    if($_POST['name2'] == ""){
        $msg_array['name2'] = $err_msg[0];
        $flag = 0;
    }

    if($_POST['tel1'] == "" || $_POST['tel2'] == "" || $_POST['tel3'] == ""){
        $msg_array["tel"] = $err_msg[0];
        del_post_val("tel1", "tel2", "tel3");
        $flag = 0;
    }elseif(!is_numeric($_POST['tel1']) || !is_numeric($_POST['tel2']) || !is_numeric($_POST['tel3'])){
        $msg_array["tel"] = $err_msg[1];
        del_post_val("tel1", "tel2", "tel3");
        $flag = 0;
    }

    if($_POST['email1'] == "" || $_POST['email2'] == ""){
        $msg_array['email'] = $err_msg[0];
        del_post_val("email1", "email2");
        $flag = 0;
    }elseif(preg_match('/^[a-z]+\.[a-z]+\.*[a-z]*$/', $_POST['email2']) === 0){
        $msg_array['email'] = $err_msg[2];
        del_post_val("email1", "email2");
        $flag = 0;
    }

    if($_POST['text'] == ""){
        $msg_array['text'] = $err_msg[0];
        $flag = 0;
    }

    if($flag != 0){
        $_SESSION['name1'] = $_POST['name1'];
        $_SESSION['name2'] = $_POST['name2'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['tel1'] = $_POST['tel1'];
        $_SESSION['tel2'] = $_POST['tel2'];
        $_SESSION['tel3'] = $_POST['tel3'];
        $_SESSION['email1'] = $_POST['email1'];
        $_SESSION['email2'] = $_POST['email2'];
        $_SESSION['address'] = $_POST['address'];
        if(isset($_POST['where'])){
            foreach($_POST['where'] as $key => $value){
                $_SESSION['where'][$key] = $value;
            }
        }
        $_SESSION['num'] = $_POST['num'];
        $_SESSION['text'] = $_POST['text'];
        // echo count($_SESSION);
        header('location: result.php');
        exit();
    }
}

function err_output($msg){
    if($msg != ""){
        return $msg;
    }
}
//POST後のフォームの初期値設定
function init_value($key){
    if(isset($_POST[$key])){
        if($_POST[$key] != ""){
            return $_POST[$key];
        }
    }
}

//ポストの値を消す
function del_post_val(...$keys){
    foreach ($keys as $value) {
        $_POST[$value] = "";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" charset="utf-8">
    <!-- <script type="text/javascript" src="check.js"></script> -->
    <title>お問い合わせフォーム</title>
</head>

<body>
    <div class="wrap">
        <section>
            <h1>お問い合わせフォーム</h1>
            <form action="contact.php" method="post" autocomplete="off" onsubmit="return check();">
                <h2>お客様情報</h2>
                <table>
                    <tbody>
                        <tr>
                            <th>姓<span class="required">[必須]</span>
                            </th>
                            <td id="name1">
                                <?php
                                echo "<input type='text' class='input_text' name='name1' placeholder='山田' value='".init_value("name1")."'>";
                                echo "<span class='err'>".err_output($msg_array['name1'])."</span>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>名<span class="required">[必須]</span>
                            </th>
                            <td id="name2">
                                <?php
                                echo "<input type='text' class='input_text' name='name2' placeholder='太郎' value='".init_value("name2")."'>";
                                echo "<span class='err'>".err_output($msg_array['name2'], "未入力です")."</span>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>性別<span class="any">[任意]</span>
                            </th>
                            <td>
                                <label>
                                    <input type="radio" name="gender" value="男" checked>男</label>
                                <label>
                                    <input type="radio" name="gender" value="女">女</label>
                                <label>
                                    <input type="radio" name="gender" value="その他">その他</label>
                            </td>
                        </tr>
                        <tr>
                            <th>電話番号<span class="required">[必須]</span>
                            </th>
                            <td id="tel">
                                <?php
                                echo '<input class="input_text" size="7" type="text" name="tel1" placeholder="03" value="'.init_value("tel1").'"> ー';
                                echo '<input class="input_text" size="7" type="text" name="tel2" placeholder="3286" value="'.init_value("tel2").'"> ー';
                                echo '<input type="text" class="input_text" size="7" name="tel3" placeholder="4777" value="'.init_value("tel3").'">';
                                echo "<span class='err'>".err_output($msg_array['tel'], "すべて入力してください")."</span>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス<span class="required">[必須]</span>
                            </th>
                            <td id="email">
                                <?php
                                echo '<input type="text" name="email1" class="input_text" placeholder="example" value="'.init_value("email1").'"> &#064';
                                echo '<input type="text" name="email2" class="input_text" placeholder="example.com" value="'.init_value("email2").'">';
                                echo "<span class='err'>".err_output($msg_array['email'], "すべて入力してください")."</span>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>住所<span class="any">[任意]</span>
                            </th>
                            <td>
                                <?php
                                echo '<input type="text" class="input_text" size="49" name="address" placeholder="東京都千代田区●●●1-1" value="'.init_value("address").'">';
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <th>どこで知ったか<span class="any">[任意]</span>
                            </th>
                            <td>
                                <label>
                                    <input type="checkbox" name="where[]" value="1">ネット</label>
                                <label>
                                    <input type="checkbox" name="where[]" value="2">新聞・雑誌</label>
                                <label>
                                    <input type="checkbox" name="where[]" value="3">友人・知り合い</label>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2>お問い合わせ内容</h2>
                <table>
                    <tbody>
                        <tr>
                            <th>カテゴリ</th>
                            <td>
                                <select name="num">
                                    <option value="1">企業について</option>
                                    <option value="2">採用について</option>
                                    <option value="3">ホームページについて</option>
                                    <option value="4">その他</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="question">
                            <th>内容<span class="required">[必須]</span></th>
                            <td id="text">
                                <?php
                                echo '<textarea name="text" rows="8" cols="60" wrap="hard" placeholder="ここに内容を記入してください">'.init_value("text").'</textarea>';
                                echo "<span class='err'>".err_output($msg_array['text'])."</span>";
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="button">
                    <input class="right" type="submit" value="送信">
                    <input class="left" name="reset" type="submit" value="リセット">
                </div>

            </form>
        </section>
    </div>
</body>

</html>
