<?php
session_start();
    //入力画面からのアクセスでなければ、戻す
    if(!isset($_SESSION['form'])){
        header('Location:info.php');
        exit();
    }else{
        $post = $_SESSION['form'];

    }

    //送信ボタンが押されたら
    if(isset($post["submit"])){
        session_unset();
        session_destroy();
        //メールを送信する
        $to = '23rd048@ms.dendai.ac.jp';
        $from = $post['email'];
        $subject = '教室予約';
        $body = <<< EOT
    ～予約内容～
    団体名：{$post['organizationname']}
    目的：{$post['purpose']}
    顧問・指導職員：{$post['teachername']}
    学生責任者
    氏名：{$post['username']}
    学年：{$post['schoolyear']}
    学系：{$post['faculty']}
    学籍番号：{$post['usernum']}
    現住所：{$post['home']}
    電話番号：{$post['tel']}
    メールアドレス：{$post['email']}
    予約教室番号：{$post['roomnum']}
    使用日：{$post['day']}
    時間：{$post['time']}
    人数：{$post['peoplenum']}
    備考：{$post['remarks']}
    EOT;
    mb_send_mail($to,$subject,$body,"From: {$from}");
        //せっションを消してアレイ画面へ
    header('Location: thanks.html');
    exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="予約確認画面">
    <title>確認-TDU教室予約</title>
    <link rel="stylesheet" href="css/confirm.css">
</head>
<body>
        <div class='top'>
            <br>
            <h1 class='top-moji'>入力情報確認</h1>
            <br>
        </div>
        <form action="thanks.html" method="post">

        <br>
        <div class='center-container'>
            <div class='big'>
                <label class='min'>団体名</label>
                <p class='min_2'><?php echo htmlspecialchars($post['organizationname']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>目的</label>
                <br>
                <p class='min_3'><?php echo nl2br(htmlspecialchars($post['purpose']));?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>顧問・指導教員氏名</label>
                <p class='min_2'><?php echo htmlspecialchars($post['teachername']);?></p>
            </div>
            <br>
            <br>
            <div class='big'>
                <label class='min_2'>=学生責任者=</label>
            </div>
            <br>
            <br>
            <div class='big'>
                <label class='min'>氏名</label>
                <p class='min_2'><?php echo htmlspecialchars($post['username']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>学年</label>
                <p class='min_2'><?php echo htmlspecialchars($post['schoolyear']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>学系</label>
                <p class='min_2'><?php echo htmlspecialchars($post['faculty']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>学籍番号</label>
                <p class='min_2'><?php echo htmlspecialchars($post['usernum']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>現住所</label>
                <br>
                <p class='min_3'><?php echo nl2br(htmlspecialchars($post['home']));?></p>
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
                <label class='min'>予約教室番号</label>
                <p class='min_2'><?php echo htmlspecialchars($post['roomnum']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>使用日</label>
                <p class='min_2'><?php echo htmlspecialchars($post['day']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>時間</label>
                <p class='min_2'><?php echo htmlspecialchars($post['time']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>人数</label>
                <p class='min_2'><?php echo htmlspecialchars($post['peoplenum']);?></p>
            </div>
            <br>
            <div class='big'>
                <label class='min'>備考</label>
                <br>
                <p class='min_3'><?php echo nl2br(htmlspecialchars($post['remarks']));?></p>
            </div>
        </div>
        <br>
        <div class='buttoncenter'>
            <input type="button" onclick="location.href='info.php'" class='button' value="戻る">
            <button type="submit" name="submit" class='button'>送信する</button>
            <br>
        </div>
    </form>
</body>
</html>