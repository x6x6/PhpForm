<?php
session_start();

// var_dump($_SESSION);
date_default_timezone_set('Asia/Tokyo');
$session_keys = array("name1", "name2", "gender", "tel1", "tel2", "tel3", "email1", "email2", "address", "where", "num", "text");
//result.php直接URLされた場合はエラー
if(count($_SESSION) < 10){
    echo "直接ここに来ないでください";
    exit();
}else{ //想定外のsessionのキーが送られてきたらエラー コンソールとかから？
    foreach ($_SESSION as $key => $value) {
        if(array_search($key, $session_keys) === false){
            echo "想定外のキーがあります！！！";
            exit();
        }
    }
}

$result = myhtmlspecialchars($_SESSION);
$category = array(1 => "企業について", 2 => "採用について", 3 => "ホームページについて", 4 => "その他");
$gender = array(1 => "男", 2 => "女", 3 => "その他");
$where = array(1 => "ネット", 2 => "新聞・雑誌", 3 => "友人・知り合い");

log_output();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" charset="utf-8">
    <title>送信結果</title>
</head>

<body>
    <div class="wrap">
        <section>
            <h1>送信結果</h1>
            <?php
            echo '<h2>お客様情報</h2>';
            echo '<table border="1">';
            echo '<tbody>';

            echo session_output("名前", "姓 or 名 が入力されていませんよ", $result['name1'], $result['name2']);
            echo session_output("性別", "性別が選択されていません", $result['gender']);
            if(is_numeric($result['tel1']) && is_numeric($result['tel2']) && is_numeric($result['tel3'])){
                echo session_output("電話番号", "すべて数字で入力してください", $result['tel1'], $result['tel2'], $result['tel3']);
            }else{
                echo session_output("すべて数字で入力してください");
            }
            echo str_replace(" ", "@", session_output("メールアドレス", "入力されていない欄があります", $result['email1'], $result['email2']));
            echo session_output("住所", "未記入", $result['address']);

            echo '<tr><th>どこで知ったか</th>';
            if(!isset($result['where'])){
                echo '<td>選択なし</td></tr>';
            }else{
                echo '<td>';
                $output = "";
                foreach($result['where'] as $key => $value) {
                    $output .= $where[$value].' &amp ';
                }
                echo trim(trim($output), "&amp");
                echo '</td></tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '<h2>お問い合わせ内容</h2>';

            echo '<table border="1">';
            echo '<tbody>';

            echo '<tr><th>カテゴリ</th>';
            echo '<td>'.$category[$result['num']].'</td></tr>';

            echo '<tr class="question"><th>お問い合わせ内容</th>';
            echo session_output("", "未記入", nl2br($result['text']));
            echo '</tbody>';
            echo '</table>';
            ?>

        </section>
    </div>
</body>

</html>

<?php
function myhtmlspecialchars($string) {
    if (is_array($string)) {
        return array_map("myhtmlspecialchars", $string);
    } else {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}

function session_output($head, $msg, ...$session_data) {
    //POSTデータを出力する
    //$msg:未入力だった場合に表示するメッセージ
    //$session_data:データ（引数分配列）
    //return: htmlに出力できる文字列
    if($head != ""){
        echo "<tr><th>".$head."</th>";
    }

    if(count($session_data) == 1){ //引数が１つだったら
        if($session_data[0] == ""){
            return "<td>".$msg."</td></tr>";
        }else{
            return "<td>".$session_data[0]."</td></tr>";
        }
    }elseif(count($session_data) == 2){  //引数が２つだったら
        if($session_data[0] == "" || $session_data[1] == ""){
            return "<td>".$msg."</td></tr>";
        }else{
            return "<td>".$session_data[0]." ".$session_data[1]."</td></tr>";
        }
    }elseif(count($session_data) == 3){ //引数が3つだったら(ほぼ電話番号用)
        if($session_data[0] == "" || $session_data[1] == "" || $session_data[2] == ""){
            return "<td>".$msg."</td></tr>";
        }else{
            return "<td>".$session_data[0]."-".$session_data[1]."-".$session_data[2]."</td></tr>";
        }
    }else{
        return "<td>".$msg."</td></tr>";
    }
}

function log_output() {
    global $where, $category;
    $fp = fopen("contact_log.txt", "a");
    fwrite($fp, date("Y/m/d H:i:s D", time())."\n");
    fwrite($fp, "名前:".$_SESSION['name1']." ".$_SESSION['name2']."\n");
    fwrite($fp, "性別:".$_SESSION['gender']."\n");
    fwrite($fp, "電話番号:".$_SESSION['tel1']."-".$_SESSION['tel2']."-".$_SESSION['tel3']."\n");
    fwrite($fp, "メールアドレス:".$_SESSION['email1']."@".$_SESSION['email2']."\n");
    if($_SESSION['address'] == ""){
        fwrite($fp, "住所:".$_SESSION['address']."\n");
    }else{
        fwrite($fp, "住所:"."未記入"."\n");
    }

    fwrite($fp, "どこで知ったか:");
    if(!isset($_SESSION['where'])){
        fwrite($fp, "選択なし");
    }else{
        $output = "";
        foreach($_SESSION['where'] as $key => $value) {
            $output .= $where[$value].' & ';
        }
        fwrite($fp, trim(trim($output), "&"));
    }
    fwrite($fp, "\n");
    fwrite($fp, "カテゴリ:".$category[$_SESSION['num']]."\n");
    fwrite($fp, "内容\n".$_SESSION['text']."\n");
    fwrite($fp, "\n");
    fclose($fp);
}
// $_SESSION = array();
// session_destroy()
?>
