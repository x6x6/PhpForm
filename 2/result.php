<?php
$result = myhtmlspecialchars($_POST);
date_default_timezone_set('Asia/Tokyo');
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$category = array(1 => "企業について", 2 => "採用について", 3 => "ホームページについて", 4 => "その他");
$gender = array(1 => "男", 2 => "女", 3 => "その他");
$where = array(1 => "ネット", 2 => "新聞・雑誌", 3 => "友人・知り合い");

$fp = fopen("contact_log.txt", "a");
fwrite($fp, date("Y/m/d H:i:s D", time())."\n");
fwrite($fp, "名前:".$_POST['name1']." ".$_POST['name2']."\n");
fwrite($fp, "性別:".$_POST['gender']."\n");
fwrite($fp, "電話番号:".$_POST['tel1']."-".$_POST['tel2']."-".$_POST['tel3']."\n");
fwrite($fp, "メールアドレス:".$_POST['email1']."@".$_POST['email2']."\n");
if($_POST['address'] == ""){
    fwrite($fp, "住所:".$_POST['addres']."\n");
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

function myhtmlspecialchars($string) {
    if (is_array($string)) {
        return array_map("myhtmlspecialchars", $string);
    } else {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}

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
            echo '<td>'.$result['name1'].' '.$result['name2'].'</td></tr>';

            echo '<tr><th>性別</span></th>';
            echo '<td>'.$result['gender'].'</td></tr>';

            echo '<tr><th>電話番号</span></th>';
            echo '<td>'.$result['tel1'].'-'.$result['tel2'].'-'.$result['tel3'].'</td></tr>';

            echo '<tr><th>メールアドレス</span></th>';
            echo '<td>'.$result['email1'].'@'.$result['email2'];

            echo '<tr><th>住所</span></th>';
            if($result['address'] == ""){
                echo '<td>未記入</td></tr>';
            }else{
                echo '<td>'.$result['address'].'</td></tr>';
            }

            echo '<tr><th>どこで知ったか</span></th>';
            if(!isset($result['where'])){
                echo '<td>選択なし</td></tr>';
            }else{
                echo '<td>';
                $output = "";
                foreach($result['where'] as $key => $value) {
                    $output .= $where[$value].' &amp ';
                    // var_dump
                }
                echo trim(trim($output), "&amp");
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '<h2>お問い合わせ内容</h2>';

            echo '<table border="1">';
            echo '<tbody>';

            echo '<tr><th>カテゴリ</th>';
            echo '<td>'.$category[$result['num']].'</td></tr>';

            echo '<tr class="question"><th>お問い合わせ内容</th>';
            echo '<td class="output">'.nl2br(htmlspecialchars($_POST['text'])).'</tr>';
            echo '</tbody>';
            echo '</table>';
            ?>

        </section>
    </div>
</body>

</html>
