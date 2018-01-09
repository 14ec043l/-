<?php

$dataFile ='kadai_22.txt';
$editFlag = $_POST['edit_num'];

if(!empty($_POST['user'])&& empty($editFlag) && !empty($_POST['password'])){

    $user = ($_POST['user']);
   
    $message = ($_POST['message']);

    $time = date('Y/m/d H:i:s');
  
    $pass = ($_POST['password']);

  $newData = (sizeof(file($dataFile)) + 1)."<>".$user."<>".$message."<>".$time."<>".$pass."<>"."\n";

    $fp = fopen($dataFile,'a'); 
    fwrite($fp, $newData); 
    fclose($fp); 
                                          }
?>

<?php
if(!empty($editFlag) && !empty($_POST['user']) && !empty($_POST['password'])){

    $user = ($_POST['user']);
   
    $message = ($_POST['message']);

    $time = date('Y/m/d H:i:s');
  
    $pass = ($_POST['password']);

$edipass = ($_POST['edipass']);

$filedata = file('kadai_22.txt'); //1行ずつ配列に格納する
$fp =fopen('kadai_22.txt', 'w+'); //空にして開く
foreach($filedata as $line) {//配列から１つずつ取り出す
 $ediData = explode('<>', $line); //<>で切って配列に

if($ediData[0] == $editFlag){

$text = $editFlag."<>".$user."<>".$message."<>".$time."<>".$pass."<>"."\n";

fputs($fp, $text); //編集した１行をファイルに追記

print "編集しました！";

}else{ //一致しない時は元のデータをそのまま書き込み

 fputs($fp, $line); //元の１行をファイルに追記

//echo "パスワードが違います。<br>";
                      }
                }
fclose($fp); //ファイルを閉じる
                      }
?>

<?php    
$edit = $_POST['editNo'];
$edipass = ($_POST['edipass']);
if(!empty($_POST['editNo']) && !empty($_POST['edipass'])){

$ediCon = file("kadai_22.txt");

for ($k = 0; $k < count($ediCon); $k++) {

$ediData = explode("<>", trim($ediCon[$k]));

if ($ediData[0] == $edit && $ediData[4]===$edipass){ //消すときの応用で、番号が一致した行の内容をあとで使うために変数に入れる。

$num=$ediData[2]; 
$who=$ediData[1]; 
$edit_num=$ediData[0]; 
$pass=$ediData[4];

echo"編集中".$edit."行目";
                          }
                                       }

                                                    }
?>

<!DOCTYPE html> 

<html lang="ja"> 
<head> 
     <meta charset="utf-8"> 
     <title>T A L K B O A R D</title> 
 
</head> 
<body> 
<h1>T A L K B O A R D</h1>
<h3> Don't forget your passwords!</h3>

     <form action="mission_2-6.php" method="POST">
       名前<input type="text" name="user"value="<?=$who; ?>"/> パスワード<input type="text" name="password" value="<?=$password; ?>"/></br></br>
       コメント<input type="text" name="message" style="width:200px;height:50px;" value="<?=$num; ?>"/> 
         <input type="submit" name="toukou" value="投稿"></br></br>
         <input name="edit_num" type="hidden" value="<?php echo $edit_num;?>"/>
         
     </form>
   
     <form action="mission_2-6.php" method="POST"> 
     削除対象番号<input type="text" name="deleteNo"> パスワード<input type="text" name="delpass" >
         <input type="submit" name="delete" value="削除">
     </form>
 
     <form action="mission_2-6.php" method="POST">
     編集対象番号<input type="text" name="editNo"> パスワード<input type="text" name="edipass">
        <input type="submit" name="edit" value="編集">
     </form>

<?php

if (isset($_POST["delete"])&&($_POST["delpass"])) {

$delete = $_POST["deleteNo"];
$delpass = ($_POST["delpass"]);

$delCon = file("kadai_22.txt");

$fp = fopen("kadai_22.txt", "w");

for ($j = 0; $j < count($delCon); $j++) {

$delDate = explode("<>", trim($delCon[$j]));

if ($delDate[0] == $delete && $delDate[4] == $delpass){
    // 両方一致すれば削除
    fwrite($fp,"削除済\n");
} else {
    // どちらかでも一致しなければ元の行を残す
    fwrite($fp, $delCon[$j]);

}
        }
fclose($fp); 
                                         }
?>

<?php
$file_name = "kadai_22.txt";
 $array = file($file_name);
 for ($i=0;$i<count($array);++$i){
 $line = explode("<>",$array[$i]);
 echo ($line[0]." ".$line[1]." ".$line[2]." ".$line[3]."<br />\n");
                                  }
?>
