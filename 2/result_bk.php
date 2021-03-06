<?php
date_default_timezone_set('Asia/Tokyo');
$post_keys = array("name1", "name2", "gender", "tel1", "tel2", "tel3", "email1", "email2", "address", "where", "num", "text");

//result.php直接URLされた場合はエラー
if(count($_POST) < 11){ //formから送られてくる最低限のキーの数以下だったらエラー
    echo "直接ここに来ないでください";
    exit();
}else{ //想定外のPOSTのキーが送られてきたらエラー コンソールとかから？
    foreach ($_POST as $key => $value) {
        if(array_search($key, $post_keys) === false){
            echo "想定外のキーがあります！！！";
            exit();
        }
    }
}

$result = myhtmlspecialchars($_POST);
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

            echo '<tr><th>お名前</span></th>';
            echo post_output("姓 or 名 が入力されていませんよお", $result['name1'], $result['name2']);

            echo '<tr><th>性別</span></th>';
            echo post_output("性別が選択されていません", $result['gender']);

            echo '<tr><th>電話番号</span></th>';
            if(ctype_digit($result['tel1']) && ctype_digit($result['tel2']) && ctype_digit($result['tel3'])){
                echo post_output("すべて数字で入力してください", $result['tel1'], $result['tel2'], $result['tel3']);
            }else{
                echo post_output("すべて数字で入力してください");
            }

            echo '<tr><th>メールアドレス</span></th>';
            echo str_replace(" ", "@", post_output("入力されていない欄があります", $result['email1'], $result['email2']));

            echo '<tr><th>住所</span></th>';
            echo post_output("未記入", $result['address']);

            echo '<tr><th>どこで知ったか</span></th>';
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
            echo post_output("未記入", nl2br($result['text']));
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

function post_output($msg, ...$post_data) {
    //POSTデータを出力する
    //$msg:未入力だった場合に表示するメッセージ
    //$post_data:POSTされたデータ（引数分配列）
    //return: htmlに出力できる文字列
    if(count($post_data) == 1){ //引数が１つだったら
        if($post_data[0] == ""){
            return "<td>".$msg."</td></tr>";
        }else{
            return "<td>".$post_data[0]."</td></tr>";
        }
    }elseif(count($post_data) == 2){  //引数が２つだったら
        if($post_data[0] == "" || $post_data[1] == ""){
            return "<td>".$msg."</td></tr>";
        }else{
            return "<td>".$post_data[0]." ".$post_data[1]."</td></tr>";
        }
    }elseif(count($post_data) == 3){ //引数が3つだったら(ほぼ電話番号用)
        if($post_data[0] == "" || $post_data[1] == "" || $post_data[2] == ""){
            return "<td>".$msg."</td></tr>";
        }else{
            return "<td>".$post_data[0]."-".$post_data[1]."-".$post_data[2]."</td></tr>";
        }
    }else{
        return "<td>".$msg."</td></tr>";
    }
}

function log_output() {
    global $where, $category;
    $fp = fopen("contact_log.txt", "a");
    fwrite($fp, date("Y/m/d H:i:s D", time())."\n");
    fwrite($fp, "名前:".$_POST['name1']." ".$_POST['name2']."\n");
    fwrite($fp, "性別:".$_POST['gender']."\n");
    fwrite($fp, "電話番号:".$_POST['tel1']."-".$_POST['tel2']."-".$_POST['tel3']."\n");
    fwrite($fp, "メールアドレス:".$_POST['email1']."@".$_POST['email2']."\n");
    if($_POST['address'] == ""){
        fwrite($fp, "住所:".$_POST['address']."\n");
    }else{
        fwrite($fp, "住所:"."未記入"."\n");
    }

    fwrite($fp, "どこで知ったか:");
    if(!isset($_POST['where'])){
        fwrite($fp, "選択なし");
    }else{
        $output = "";
        foreach($_POST['where'] as $key => $value) {
            $output .= $where[$value].' & ';
        }
        fwrite($fp, trim(trim($output), "&"));
    }
    fwrite($fp, "\n");
    fwrite($fp, "カテゴリ:".$category[$_POST['num']]."\n");
    fwrite($fp, "内容\n".$_POST['text']."\n");
    fwrite($fp, "\n");
    fclose($fp);
}
?>
