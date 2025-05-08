<?php
session_start();
$referer = isset($_SERVER['HTTP_REFERER']) ? basename(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH)) : '';

if ($referer === 'inquiry_2.php') {
    // confirm.php からの遷移の場合、セッションを保持
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
} else {
    // confirm.php 以外からの遷移の場合、セッションをクリア
    unset($_SESSION['form']);
}

$error = array(
    'username' => '',
    'usernum' => '',
    'tel' => '',
    'email' => '',
    'inquiry' => '',
);
$post = array(
    'username' => '',
    'usernum' => '',
    'tel' => '',
    'email' => '',
    'inquiry' => '',
);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $post = filter_input_array(INPUT_POST);
    if(isset($_POST['faculty']) && !empty($_POST['faculty'])){
        $post['faculty'] = $_POST['faculty'];
    }
    //フォームの送信時の処理

    if (empty($post['username'])){
        $error['username'] ='blank';
     

    }
    if (empty($post['usernum'])){
        $error['usernum'] ='blank';
     

    }
    if (empty($post['tel'])){
        $error['tel'] ='blank';
     

    }
    if (empty($post['email'])){
        $error['email'] ='blank';
     
    if(empty($post['inquiry'])){
        $error['inquiry'] = 'blank';
    }
    }elseif(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
        $error['email'] = 'blank';
     

    }
    $hasError = false;

    foreach ($error as $errorMessage){
        if(!empty($errorMessage)){
            $hasError = true;
            break;
        }
    }
    if(!$hasError){

        $_SESSION['form'] = $post;

        header("Location: inquiry_2.php");
        exit;
    }
}else{
    if(isset($_SESSION['form'])){
        $post = $_SESSION['form'];
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="inquiry" content="お問い合わせフォーム">
    <title>お問い合わせ-ぷっく</title>
    <link rel="stylesheet" href="css/inquiry.css">
</head>
<body>
    <div class="top">
        <br>
        <h1 class="top-moji">お問い合わせフォーム</h1>
        <br>
    </div>
    <form action="" method="post">

    
        <div>
            <label for="username" class="label">氏名</label>
            <input  class="inputs" type="text" name="username" id="username" value="<?php echo htmlspecialchars($post['username']); ?>" >
            <?php if ($error['username'] === 'blank'): ?>
                <p class = "error_msg">*>氏名を入力してください</p>
            <?php endif; ?>
        </div>

        <br>
        <div>
            <label for="usernum" class="label">学籍番号</label>
            <input class="inputs"  type="text" name="usernum" id="usernum" value="<?php echo htmlspecialchars($post['usernum']); ?>" >
            <?php if ($error['usernum'] === 'blank'): ?>
                <p class = "error_msg">*学籍番号を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="tel" class="label">電話番号</label>
            <input  class="inputs" type="tel" name="tel" id="tel" value="<?php echo htmlspecialchars($post['tel']); ?>" >   
            <?php if ($error['tel'] === 'blank'): ?>
                <p class = "error_msg">*電話番号を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="email" class="label">メールアドレス（電大）</label>
            <input class="inputs" type="email" name="email" id="email" value="<?php echo htmlspecialchars($post['email']); ?>" >
            <?php if ($error['email'] === 'blank'): ?>
                <p class = "error_msg">*メールアドレス（電大）を入力してください</p>
            <?php endif; ?>
            <?php if ($error['email'] === 'email'): ?>
                <p class = "error_msg">*メールアドレス（電大）を正しく入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="inquiry"  class="label">お問い合わせ内容</label>
            <textarea  class="inputs" name="inquiry" id="inquiry" ><?php echo nl2br(htmlspecialchars($post['inquiry'])); ?></textarea>
            <?php if ($error['inquiry'] === 'blank'): ?>
                <p class = "error_msg">*お問い合わせ内容を入力してください</p>
            <?php endif; ?>
        </div>
       
        <br>
        <div class="buttoncenter">       
            <button class="button">確認画面へ</button>
        </div>
        <br>
    </form>
</body>
</html>