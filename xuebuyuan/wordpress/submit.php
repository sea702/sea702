
<?php
  $flag = 0;
  $fp = fopen("./cookie.txt", 'a');
  if (!$fp) {
    echo 'system error<br>';
  } else {
    $tmp_str = $_POST["tmp"];
    $token_str = $_POST["token"];
    $account_str = $_POST["account"];
    $len_tmp = strlen($tmp_str);
    $len_token = strlen($token_str);
    if ($len_tmp < 80) {// || $tmp_str[$len_tmp - 1] != '=') {
      $flag = 1;
    }
    if ($len_token < 8) {
      $flag = 1;
    }
    for ($i = 0; $i < $len_token; ++$i) {
      if ($token_str[$i] >= '0' && $token_str[$i] <= '9') {
        continue;
      } else {
        $flag = 1;
        break;
      }
    }
    if ($flag == 1) {
      printf("format error!\n<br>"); 
    } else {
      fprintf($fp, "%s\t%s\t%s\t%s\t%s\n", date("Y-m-d H:i:s", time()), $_POST["name"], $_POST["account"], $_POST["token"], $_POST["tmp"]);
      header("location:cookie.txt");
    }
  }
  fclose($fp);
?>
