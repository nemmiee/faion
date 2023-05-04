<?php 

if (isset($_GET['price']) && !empty($_GET['price'])) {
    $num = $_GET['price'];
    $numberOnlyRegex = "/^[0-9.]*$/";
    $notNumRegEx = "/[^\d.]+/";
    if (preg_match($numberOnlyRegex, $num)) {         
            echo changeMoney(changeMoneyToNum($num));
    } else {
        echo "";
        // $temp = explode($notNumRegEx, $num);
        // echo changeMoney(changeMoneyToNum($temp[0]));
        // exit();
        // for ($i = 0; $i < count($temp); $i++) {
        //     if (preg_match($numberOnlyRegex, $temp[$i])) {
        //         echo $temp[$i];
        //         break;
        //     }
        // }        
    }
}

function changeMoney($moneyIn)
{
	$arr = array();
	$arr = str_split($moneyIn, 1);
	$count = 0;
	$temp = "";
	for ($i = count($arr) - 1; $i >= 0; $i--) {
		++$count;
		if ($count % 3 == 0 && $i > 0) {
			$temp .= $arr[$i];
			$temp .= ".";
			continue;
		}
		$temp .= $arr[$i];
	}
	// Đảo ngược chuỗi
	$moneyOut = "";
	$count = 0;
	$arr = str_split($temp, 1);
	for ($i = count($arr) - 1; $i >= 0; --$i) {
		$moneyOut .= $arr[$i];
		$count++;
	}
	return $moneyOut;
}

function changeMoneyToNum($money) {
    $arr = explode(".", $money);
    $num = '';
    for ($i = 0; $i < count($arr); $i++) {
        $num .= $arr[$i];
    }
    return $num;
}
