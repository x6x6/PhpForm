<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" charset="utf-8">
    <script type="text/javascript" src="check.js"></script>
    <title>お問い合わせフォーム</title>
</head>

<body>
    <div class="wrap">
        <section>
            <h1>お問い合わせフォーム</h1>
            <form action="result.php" method="post" autocomplete="off" onsubmit="return check();">
                <h2>お客様情報</h2>
                <table>
                    <tbody>
                        <tr>
                            <th>姓<span class="required">[必須]</span>
                            </th>
                            <td id="name1">
                                <input type="text" class="input_text" name="name1" placeholder="山田"><span class="err"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>名<span class="required">[必須]</span>
                            </th>
                            <td id="name2">
                                <input type="text" class="input_text" name="name2" placeholder="太郎"><span class="err"></span>
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
                                <input class="input_text" size="7" type="text" name="tel1" placeholder="03"> ー
                                <input class="input_text" size="7" type="text" name="tel2" placeholder="3286"> ー
                                <input type="text" class="input_text" size="7" name="tel3" placeholder="4777">
                                <span class="err"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス<span class="required">[必須]</span>
                            </th>
                            <td id="email">
                                <input type="text" name="email1" class="input_text" placeholder="example"> &#064;
                                <input type="text" name="email2" class="input_text" placeholder="example.com"><span class="err"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>住所<span class="any">[任意]</span>
                            </th>
                            <td>
                                <input type="text" class="input_text" size="49" name="address" placeholder="東京都千代田区●●●1-1">
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
                                <textarea name="text" rows="8" cols="60" wrap="hard" placeholder="ここに内容を記入してください"></textarea><span class="err"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="button">
                    <input class="right" type="submit" value="送信">
                    <input class="left" type="reset" value="リセット">
                </div>

            </form>
        </section>
    </div>
</body>

</html>
