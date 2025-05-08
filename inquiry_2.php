<?php
session_start();
    //入力画面からのアクセスでなければ、戻す
    if(!isset($_SESSION['form'])){
        header('Location:inquiry.php');
        exit();
    }else{
        $post = $_SESSION['form'];

    }

    //送信ボタンが押されたら
    if(isset($post["submit"])){
        //メールを送信する
        $to = "23rd048@ms.dendai.ac.jp";
        $from = $post['email'];
        $subject = "お問い合わせ";
        $body = <<< EOT
    ～予約内容～
    氏名：{$post['username']}
    学籍番号：{$post['usernum']}
    電話番号：{$post['tel']}
    メールアドレス：{$post['email']}
    お問い合わせ内容：{$post['inquiry']}

    EOT;
    mb_send_mail($to,$subject,$body,"From: {$from}");
        //せっションを消してアレイ画面へ
    unset($_SESSION['form']);
    header('Location: inquiry_3.html');
    exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="お問い合わせフォーム確認画面">
    <title>お問い合わせ確認-ぷっく</title>
    <link rel="stylesheet" href="css/inquiry_2.css">
</head>
<body>
    <form action="inquiry_3.html" method="post">
        <div class='top'>
            <br>
            <h1 class='top-moji'>お問い合わせ内容確認</h1>
            <br>
        </div>
        <br>
        <div class='big'>
            <label class='min'>氏名</label>
            <p class='min_2'><?php echo htmlspecialchars($post['username']);?></p>
        </div>
        <br>
        <div class='big'>
            <label class='min'>学籍番号</label>
            <p class='min_2'><?php echo htmlspecialchars($post['usernum']);?></p>
        </div>
        <br>
        <div class='big'>
            <label class='min'>電話番号</label>
            <p class='min_2'><?php echo htmlspecialchars($post['tel']);?></p>
        </div>
        <br>
        <div class='big'>
            <label class='min'>メールアドレス</label>
            <p class='min_2'><?php echo htmlspecialchars($post['email']);?></p>
        </div>
        <br>
        <div class='big'>
            <label class='min'>お問い合わせ内容</label>
            <br>
            <p class='min_2_1'><?php echo nl2br(htmlspecialchars($post['inquiry']));?></p>
        </div>
        <div class='buttoncenter'>
            <input type="button" onclick="location.href='inquiry.php'" class='button' value="戻る">
            <button type="submit" name="submit" class='button'>送信する</button>
        </div>
        <br>
        <br>
        <br>
    </form>
</body>
</html>