<?php
session_start();
$referer = isset($_SERVER['HTTP_REFERER']) ? basename(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH)) : '';

if ($referer === 'confirm.php') {
    // confirm.php からの遷移の場合、セッションを保持
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
} else {
    // confirm.php 以外からの遷移の場合、セッションをクリア
    unset($_SESSION['form']);
}

$roomnumValue = isset($_GET['room']) ? htmlspecialchars($_GET['room']) : '';
$dateValue = isset($_GET['date']) ? htmlspecialchars($_GET['date']) : '';
$timeValue = isset($_GET['time']) ? htmlspecialchars($_GET['time']) : '';
$peopleValue = isset($_GET['people']) ? htmlspecialchars($_GET['people']) : '';

$error = array(
    'organizationname' => '',
    'purpose' => '',
    'teachername' => '',
    'username' => '',
    'schoolyear' => '',
    'faculty' => '',
    'usernum' => '',
    'home' => '',
    'tel' => '',
    'email' => '',
    'roomnum' => '',
    'day' => '',
    'time' => '',
    'peoplenum' => '',
    'remarks' => ''
);

$post = array(
    'organizationname' => '',
    'purpose' => '',
    'teachername' => '',
    'username' => '',
    'schoolyear' => '',
    'faculty' => '',
    'usernum' => '',
    'home' => '',
    'tel' => '',
    'email' => '',
    'roomnum' => $roomnumValue,
    'day' => $dateValue,
    'time' => $timeValue,
    'peoplenum' => $peopleValue,
    'remarks' => ''
);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $post = filter_input_array(INPUT_POST);
    if(isset($_POST['faculty']) && !empty($_POST['faculty'])){
        $post['faculty'] = $_POST['faculty'];
    }
    //フォームの送信時の処理
    if (empty($post['organizationname'])){
        $error['organizationname'] ='blank';
     
    }
    if (empty($post['purpose'])){
        $error['purpose'] ='blank';
     

    }
    if (empty($post['username'])){
        $error['username'] ='blank';
     

    }
    if (empty($post['usernum'])){
        $error['usernum'] ='blank';
     

    }
    if (empty($post['schoolyear'])) {
        $error['schoolyear'] = 'blank';
     

    }
    if(empty($post['faculty'])){
        $error['faculty'] ='blank';
     

    }
    if (empty($post['home'])){
        $error['home'] ='blank';
     

    }
    if (empty($post['tel'])){
        $error['tel'] ='blank';
     

    }
    if (empty($post['email'])){
        $error['email'] ='blank';
     

    }elseif(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
        $error['email'] = 'blank';
     

    }
    if (empty($post['roomnum'])){
        $error['roomnum'] ='blank';
     

    }
    if (empty($post['day'])){
        $error['day'] ='blank';
     

    }
    if (empty($post['time'])){
        $error['time'] ='blank';
     

    }
    if (empty($post['peoplenum'])){
        $error['peoplenum'] ='blank';
     

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

        header("Location: confirm.php");
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
    <meta name="info" content="予約情報入力フォーム">
    <title>情報入力-TDU教室予約</title>
    <link rel="stylesheet" href="css/info.css">
</head>
<body>
    <div class="top">
        <br>
        <h1 class="top-moji">予約情報入力フォーム</h1>
        <br>
    </div>
    <form action="" method="post">
              <div>
            <label for="organizationname" class="label">団体名</label>
            <input type="text" name="organizationname" id="organizationname" value="<?php echo htmlspecialchars($post['organizationname']); ?>" class="inputs" >
            <?php if ($error['organizationname'] === 'blank'): ?>
                <p class = "error_msg">*団体名を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="purpose"  class="label">目的</label>
            <textarea  class="inputs" name="purpose" id="purpose" cols="30" rows="10"><?php echo htmlspecialchars($post['purpose']); ?></textarea>
            <?php if ($error['purpose'] === 'blank'): ?>
                <p class = "error_msg">*目的を入力してください</p>
                
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="teachername" class="label">顧問・指導教員氏名</label>
            <input  class="inputs" type="text" name="teachername" id="teachername" value="<?php echo htmlspecialchars($post['teachername']); ?>">
        </div>
        <br>
        <div>
            <p>=学生責任者=</p>
            <br>
            <label for="username" class="label">氏名</label>
            <input  class="inputs" type="text" name="username" id="username" value="<?php echo htmlspecialchars($post['username']); ?>" >
            <?php if ($error['username'] === 'blank'): ?>
                <p class = "error_msg">*>氏名を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <p class="label2">学年</p>
            <label for="1" class='radio'><input type="radio" name="schoolyear" id="1" value="1年"<?php if (isset($post['schoolyear']) && $post['schoolyear'] === '1年') echo 'checked'; ?>>1年</label>
            <label for="2" class='radio'><input type="radio" name="schoolyear" id="2" value="2年"<?php if (isset($post['schoolyear']) && $post['schoolyear'] === '2年') echo 'checked'; ?>>2年</label>
            <label for="3" class='radio'><input type="radio" name="schoolyear" id="3" value="3年"<?php if (isset($post['schoolyear']) && $post['schoolyear'] === '3年') echo 'checked'; ?>>3年</label>
            <label for="4" class='radio'><input type= "radio" name="schoolyear" id="4" value="4年"<?php if (isset($post['schoolyear']) && $post['schoolyear'] === '4年') echo 'checked'; ?>>4年</label>
            <label for="5" class='radio'><input type="radio" name="schoolyear" id="5" value="修士課程"<?php if (isset($post['schoolyear']) && $post['schoolyear'] === '修士課程') echo ' checked'; ?>>修士課程</label>

            <?php   if($error['schoolyear'] === 'blank'): ?>
                <p class = "error_msg">*学年を選択してください</p>
            <?php endif; ?>    
        </div>
        <br>
        <div>
            <p class="label2">学系</p>
            <label for="11" class='radio'><input type="radio" name="faculty" id="11" value="理学系"<?php if (isset($post['faculty']) && $post['faculty'] === '理学系') echo 'checked'; ?>>理学系</label>
			<label for="22" class='radio'><input type="radio" name="faculty" id="22" value="生命科学系"<?php if (isset($post['faculty']) && $post['faculty'] === '生命科学系') echo 'checked'; ?>>生命科学系</label>
			<label for="33" class='radio'><input type="radio" name="faculty" id="33" value="情報システムデザイン学系"<?php if (isset($post['faculty']) && $post['faculty'] === '情報システムデザイン学系') echo 'checked'; ?>>情報システムデザイン学系</label><br>
			<label for="44" class='radio_2'><input type="radio" name="faculty" id="44" value="機械工学系"<?php if (isset($post['faculty']) && $post['faculty'] === '機械工学系') echo 'checked'; ?>>機械工学系</label>
			<label for="55" class='radio_2'><input type="radio" name="faculty" id="55" value="電子情報・生体医工学系"<?php if (isset($post['faculty']) && $post['faculty'] === '電子情報・生体医工学系') echo ' checked'; ?>>電子情報・生体医工学系</label>
		<label for="66" class='radio_2'><input type="radio" name="faculty" id="66" value="建築・都市環境学系"<?php if (isset($post['faculty']) && $post['faculty'] === '建築・都市環境学系') echo 'checked'; ?>>建築・都市環境学系</label>

            <?php   if($error['faculty'] === 'blank'): ?>
                <p class = "error_msg">*学系を選択してください</p>
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
            <label for="home" class="label">現住所</label>
            <textarea  class="inputs" type="text" name="home" id="home" cols="30" rows="10"  ><?php echo htmlspecialchars($post['home']); ?></textarea>
            <?php if ($error['home'] === 'blank'): ?>
                <p class = "error_msg">*現住所を入力してください</p>
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
            <label for="roomnum" class="label">予約教室番号</label>
            <input  class="inputs" type="text" name="roomnum" id="roomnum" value="<?php echo htmlspecialchars($post['roomnum']); ?>" >
            <?php if ($error['roomnum'] === 'blank'): ?>
                <p class = "error_msg">*予約教室番号を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="day" class="label">使用日</label>
            <input  class="inputs" type="text" name="day" id="day" value="<?php echo htmlspecialchars($post['day']); ?>" > 
            <?php if ($error['day'] === 'blank'): ?>
                <p class = "error_msg">*使用日を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="time" class="label">時間</label>
            <input type="text"  class="inputs" name="time" id="time" value="<?php echo htmlspecialchars($post['time']); ?>" >
            <?php if ($error['time'] === 'blank'): ?>
                <p class = "error_msg">*時間を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="peoplenum" class="label">人数</label>
            <input  class="inputs" type="text" name="peoplenum" id="peoplenum" value="<?php echo htmlspecialchars($post['peoplenum']); ?>" >    
            <?php if ($error['peoplenum'] === 'blank'): ?>
                <p class = "error_msg">*人数を入力してください</p>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label for="remarks" class="label">備考</label>
            <textarea  class="inputs" type="text" name="remarks" id="remarks" cols="30" rows="10"><?php echo htmlspecialchars($post['remarks']); ?></textarea>
        </div>
      
        <br>
        <div class="buttoncenter">       
            <button class="button">確認画面へ</button>
        </div>
        <br>
    </form>
</body>
</html>