  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style.css" charset="utf-8">
      <title>お問い合わせフォーム</title>
    </head>
    <body>
      <div class="wrap">
        <section>
          <h1>お問い合わせフォーム</h1>

          <form class="" action="check.php" method="post">
            <h2>お客様情報</h2>
            <table border="1">
              <tbody>
                <tr><th>姓<span class="need">[必須]</span></th><td><input type="text" name="name1" placeholder="山田"></td></tr>
                <tr><th>名<span class="need">[必須]</span></th><td><input type="text" name="name2" placeholder="太郎"></td></tr>
                <tr>
                  <th>性別</th>
                  <td>
                    <label><input type="radio" name="gender" value="1">男</label>
                    <label><input type="radio" name="gender"　value="2">女</label>
                    <label><input type="radio" name="gender"　value="3">その他</label>
                  </td>
                </tr>
                <tr>
                  <th>電話番号<span class="need">[必須]</span></th>
                  <td>
                    <input type="text" name="tel1" placeholder="090">-<input type="text" name="tel2" placeholder="2313">-<input type="text" name="tel3" placeholder="3512">
                  </td>
                </tr>
                <tr>
                  <th>メールアドレス<span class="need">[必須]</span></th>
                  <td><input type="text" name="email1" placeholder="example">@<input type="text" name="email2" placeholder="example.com"></td></tr>
                <tr><th>住所</th><td><input type="text" name="address" placeholder="東京都千代田区●●●1-1"></td></tr>
                <tr>
                  <th>どこで知ったか</th>
                  <td>
                    <label><input type="checkbox" name="where[]" value="ネット">ネット</label>
                    <label><input type="checkbox" name="where[]" value="新聞・雑誌">新聞・雑誌</label>
                    <label><input type="checkbox" name="where[]" value="友人">友人</label>
                  </td>
                </tr>
              </tbody>
            </table>
            <h2>お問い合わせ内容</h2>
            <table border="1">
              <tbody>
                <tr>
                  <th>質問カテゴリ<span class="need">[必須]</span></th>
                  <td>
                    <select name="category">
                      <option value="1">企業について</option>
                      <option value="2">採用について</option>
                      <option value="3">ホームページについて</option>
                      <option value="4">その他</option>
                    </select>
                  </td>
                </tr>
                <tr class="question"><th>質問内容<span class="need">[必須]</span></th><td><textarea name="question" rows="8" cols="60"></textarea></td></tr>

              </tbody>
            </table>
            <input class="submit" type="submit" value="送信内容の確認">
          </form>
        </section>

      </div>
    </body>
  </html>
