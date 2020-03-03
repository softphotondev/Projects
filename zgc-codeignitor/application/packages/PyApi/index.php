<?php /** @noinspection PhpUnreachableStatementInspection */
require_once "vendor/autoload.php";
use AmmadKhalid\ExecPy\Api;

$api = new Api("/usr/local/bin/python3", "autorecord");

$api->addArgument(['run' => 'fuck']);
$api->addArgument('fuck' , 'off');
$api->addPositionalArgument("ads");
$api->addPositionalArgument("ads");
$array = [
        'asdasd',
        'adasd',
        'adasd'
];
$api->removeDuplicates($array);

var_dump($array);

die;

$post = (object) $_POST;
$f = escapeshellarg($post->f_name);
$fl = escapeshellarg($post->l_name);
$dob = escapeshellarg($post->dob);
$ssn = escapeshellarg($post->SSN);
$mail = escapeshellarg($post->mail);
$oc = escapeshellarg($post->oc);
$phone = escapeshellarg($post->phone);
$r = escapeshellarg($post->r);
$m_s = escapeshellarg($post->m_s);
$a = escapeshellarg($post->a);
$ic = escapeshellarg($post->t_i);
$cmd = "autorecord -register-credit-card --f_name {$f} --l_name $fl --dob $dob --ssn $ssn --mail $mail --occupation $oc --phone $phone --total_income $ic --rent $r --cc_monthly_spent $m_s --address $a";

if (!empty($_POST)):
	$req = shell_exec($cmd);
	//echo "<pre>";
	print_r(json_decode($req));
	//echo "</pre>";
endif;
?>

<form method="POST" action="index.php">
	<input placeholder="First Name" name="f_name"/><br/>
	<input placeholder="Last Name" name="l_name"/><br/>
	<input placeholder="Mail Address" name="mail"/><br/>
	<input placeholder="Ocupation" name="oc"/><br/>
	<input placeholder="Phone" name="phone"/><br/>
	<input placeholder="total income" name="t_i"/><br/>
	<input placeholder="montly spent" name="m_s"/><br/>
	<input placeholder="address" name="a"/><br/>
	<input placeholder="DOB" name="dob"/><br/>
	<input placeholder="SSN" name="SSN"/><br/>
	<input placeholder="Rent" name="r"/><br/>
	<button type="submit">Submit</button>
</form>