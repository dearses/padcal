<?php
session_start();
$apkver="7.2.2";
$apkfile="pad722.apk";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>pad calculator</title>
<meta name="Keywords" content="智龙迷城，伤害计算器" />
<meta name="Description" content="" />
<meta name="Version" content="20140607-1">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<style type="text/css">
  p.small {line-height: 150%}
  p.big {line-height: 200%}
  span.copybutton {border: 1px solid #000000;padding: 3px 3px;font-weight:normal;background: #CCCCFF;font-size:14px}
</style>
<script type="text/javascript" src="ZeroClipboard.js"></script>
<script language="JavaScript">
  var clip = null;
  function $(id) { return document.getElementById(id); }
  function init() {
        clip = new ZeroClipboard.Client();
        clip.setHandCursor(true);
        clip.addEventListener('mouseOver', function (client) {
    // update the text on mouse over

    clip.setText( $('result').innerHTML.replace(/<br>/g,"\r\n").replace(/<[^>]*>/g,"") );
        });

        clip.addEventListener('complete', function (client, text) {
    //debugstr("Copied text to clipboard: " + text );
    alert("计算结果已经复制，你可以使用Ctrl+V 粘贴。");
        });
        clip.glue('clip_button', 'clip_container' );
  }
</script>
<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?67d69f243b64a168fda7e5af24b06988";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();

function orbcheck()
{
  var orbsum=Number(document.cal.orb1.value)+Number(document.cal.orb2.value)+Number(document.cal.orb3.value)+Number(document.cal.orb4.value)+Number(document.cal.orb5.value);
  if (orbsum > 30)
    {alert("珠子总数不能超过30颗!");
     return false;
    }
}

function atkselect()
{
var myatk=document.getElementById("atkoption");
document.getElementById("atk").value=myatk.options[myatk.selectedIndex].text;
}

function skillselect()
{
var myskill=document.getElementById("skilloption");
document.getElementById("skill").value=myskill.options[myskill.selectedIndex].text;
}
</script>
</head>
<body onLoad="init()">
<div align="center">
<table border="0" cellpadding="10" cellspacing="0" bgcolor="black"><tr><td bgcolor="#FFFFFF">
<form name=cal action="" onsubmit="return orbcheck()" method="post">
<p class="big">
    队长倍率:
 <select name="leader1" >
<?php
   $leadermtp=array(1,1.35,1.5,2,2.5,3,3.5,4,4.5,5,6,7,8,10);
   foreach ($leadermtp as $leadervalue){
        if (isset($_POST['leader1']) && $_POST['leader1'] == $leadervalue) {
        echo "<option value=\"".$_POST['leader1']."\" selected>".$_POST['leader1']."</option>\n";
        }
        else
        echo "<option value=\"$leadervalue\">$leadervalue</option>\n";
   }
?>
 </select> 
 <span> × </span> 
 <select name="leader2" >
<?php
   foreach ($leadermtp as $leadervalue){
        if (isset($_POST['leader2']) && $_POST['leader2'] == $leadervalue) {
        echo "<option value=\"".$_POST['leader2']."\" selected>".$_POST['leader2']."</option>\n";
        }
        else
        echo "<option value=\"$leadervalue\">$leadervalue</option>\n";
   }
?>
 </select> 

    <br>主动技能倍率:
    <input type="text" id="skill" name="skill"  value="<?=isset($_POST['skill'])?$_POST['skill']:1;?>" size="5" maxlength="5" />
 <select id="skilloption" onchange="skillselect()">
<?php
   $skillmtp=array(1,1.2,1.3,1.5,2,2.5,3);
   foreach ($skillmtp as $skillvalue){
        if (isset($_POST['skill']) && $_POST['skill'] == $skillvalue) {
        echo "<option value=\"".$_POST['skill']."\" selected>".$_POST['skill']."</option>\n";
        }
        else
	echo "<option value=\"$skillvalue\">$skillvalue</option>\n"; 
   }
?>
 </select> 

    <br>觉醒横排加强数:
 <select name="jxnum" >  
<?php
    for ($i=0;$i<=18;$i++){
	if (isset($_POST['jxnum']) && $_POST['jxnum'] == $i) {
	echo "<option value=\"".$_POST['jxnum']."\" selected>".$_POST['jxnum']."</option>\n";	
	}
	else
	echo "   <option value=\"$i\">$i</option>\n";
    }
?>
 </select>

    <br>连击数combo:
 <select name="combo" >  
<?php
    for ($i=1;$i<=10;$i++){
	if (isset($_POST['combo']) && $_POST['combo'] == $i) {
	echo "<option value=\"".$_POST['combo']."\" selected>".$_POST['combo']."</option>\n";	
	}
	else
	echo "   <option value=\"$i\">$i</option>\n";
    }
?>
 </select>

    <br>珠子排列方式：<br>

<?php
 for ($j=1;$j<=5;$j++) {
   if ($j > 1) {
   echo "<span> + </span>";
   }
   echo "<select name=\"orb$j\" >";
    for ($i=0;$i<=30;$i++){
	if ($i == 1 || $i == 2) {
	}
	else {
		        if (isset($_POST['orb'.$j]) && $_POST['orb'.$j] == $i) {
        		echo "<option value=\"".$_POST['orb'.$j]."\" selected>".$_POST['orb'.$j]."</option>\n";
        		}
        		else
			echo "   <option value=\"$i\">$i</option>\n";
	}
    }
   echo "</select>";
 }
?>



    <br>珠子摆放的横排数:
 <select name="linenum" >
<?php
    for ($i=0;$i<=3;$i++){
        if (isset($_POST['linenum']) && $_POST['linenum'] == $i) {
        echo "<option value=\"".$_POST['linenum']."\" selected>".$_POST['linenum']."</option>\n";
        }
        else
        echo "   <option value=\"$i\">$i</option>\n";
    }
?>
 </select> 

    <br>攻击力:
    <input type="text" id="atk" name="atk"  value="<?=isset($_POST['atk'])?$_POST['atk']:5000;?>" size="5" maxlength="5" />
    <select id="atkoption" onchange="atkselect()">  
<?php
    for ($i=5000;$i<=12000;$i+=500){
	if (isset($_POST['atk']) && $_POST['atk'] == $i) {
	echo "<option value=\"".$_POST['atk']."\" selected>".$_POST['atk']."</option>\n";	
	}
	else
	echo "   <option value=\"$i\">$i</option>\n";
    }
?>
    </select>


    <br>属性相克:
    <input type="checkbox" name="anti" value="2"/ <?php if (isset($_POST['anti']) && $_POST['anti']=='2') echo 'checked'; ?>>
    <span>　</span>点灯:
    <input type="checkbox" name="light" value="1"/ <?php if (isset($_POST['light']) && $_POST['light']=='1') echo 'checked'; ?>>
    <span>　</span>
    <input type="submit" name="submit" value="计算" />
    <br><a href="http://www.padcal.com/rowenhanced.jpg" target="_blank">横排强化排珠图</a>  <span>　</span> 
    <a href="http://www.padcal.com/twopronged.jpg" target="_blank">二体攻击排珠图</a>  <span>　</span> 
    <a href="http://www.padcal.com/heroicgod.jpg" target="_blank">英雄神排珠图</a>  <span>　</span> 
    <br><a href="http://www.padcal.com/<?=$apkfile;?>" target="_blank">安卓<?=$apkver;?>版安装包</a>  <span>　</span> <a href="http://tieba.baidu.com/p/3031717987" target="_blank">给我留言</a>
</p>
</form>
</td></tr></table>
</div>
<div align="center">
<?php
if (isset($_POST['leader1'])) {
	$leader1=$_POST['leader1'];
}

if (isset($_POST['leader2'])) {
	$leader2=$_POST['leader2'];
}

if (isset($_POST['skill'])) {
	$skill=$_POST['skill'];
}

if (isset($_POST['jxnum'])) {
	$jxnum=$_POST['jxnum'];
}

if (isset($_POST['combo'])) {
	$combo=$_POST['combo'];
}

for ($i=1;$i<=5;$i++) {
 if (isset($_POST['orb'.$i])) {
	$orb[$i]=intval($_POST['orb'.$i])>0?intval($_POST['orb'.$i]):0;
 }
}

if (isset($_POST['linenum'])) {
	$linenum=intval($_POST['linenum']);
}

if (isset($_POST['atk'])) {
	$atk=intval($_POST['atk']);
}

if (isset($_POST['light'])) {
	$light=$_POST['light'];
}

if (isset($_POST['anti'])) {
	$anti=$_POST['anti'];
}
else {
	$anti=1;
}

if (isset($_POST['light'])) {
	$light=$_POST['light'];
}
else {
	$light=0;
}

if (isset($_POST['leader1'])) {
$leader=$leader1*$leader2;
echo "<table border=\"0\" cellpadding=\"10\" cellspacing=\"1\" bgcolor=\"black\" ><tr><td bgcolor=\"#F0F8FF\">";
echo "<p>本<br>次<br>计<br>算<br>结<br>果</p></td><td bgcolor=\"#F0F8FF\" >";
echo "<div id=\"result\"><p style=\"display:none;\">";
echo "以下结果来自www.padcal.com<br>";
echo "队长倍率 = $leader1 × $leader2 <br>";
echo "主动技能倍率 = $skill <br>";
echo "觉醒横排加强数 = $jxnum <br>";
//echo "连击数combo = $combo <br>";
echo "攻击力 = $atk <br>";
if ($anti == 2){
echo "属性相克<br>";
}
echo "</p>";
echo "<p class=\"small\">";
echo "珠子排列方式为 ".$orb[1];
for ($i=2;$i<=5;$i++) {
    if ($orb[$i] > 0) 	
	echo " + ".$orb[$i];
}
echo "，横排数为${linenum}<br>";

for ($i=1;$i<=5;$i++) {
	if ($orb[$i] < 6 ){
		$hpnum[$i]=0;
	}
	elseif ($orb[$i] > 25 ){
		$hpnum[$i]=1;
	}
	else {
		$hpnum[$i]=$linenum;
	}
}

for ($i=1;$i<=5;$i++) {
	if ($orb[$i] < 3 ){
		$mtp[$i]=0;
	}
	else 
	$mtp[$i]=(1+0.25*($orb[$i]-3))*(1+0.1*$jxnum*$hpnum[$i])*(1+0.06*$orb[$i]*$light)*$skill*$leader*(1+0.25*($combo-1));
}
$totalmtp=array_sum($mtp)*$anti;
$fullmtp=7.75*(1+$light*1.8)*(1+0.1*$jxnum)*$skill*$leader*$anti;
$damage=$atk*$totalmtp;
$fulldamage=$atk*$fullmtp;
switch ($light)
{
case 0:
$checklight="";
break;
case 1:
$checklight="点灯时";
break;
}
if ($damage < 5350000)
{
echo "<b><font color=#000000>${checklight}${combo}C伤害为 $atk*$totalmtp=${damage}</font></b><br>";
}
else
{
echo "<b><font color=#FF0000>${checklight}${combo}C伤害为 $atk*$totalmtp=${damage}， 秒杀神王！</font></b><br>";
}

if ($fulldamage < 5350000)
{
echo "<b><font color=#000000>${checklight}全屏1C伤害为 <b>$atk*$fullmtp=${fulldamage}</font></b><br>";
}
else
{
echo "<b><font color=#0000FF>${checklight}全屏1C伤害为 $atk*$fullmtp=${fulldamage}， 秒杀神王！</font></b><br>";
}
echo "</p></div>";
//echo "<span id=\"clip_container\"><span id=\"clip_button\"><input type=\"button\" name=\"button\" value=\"复制结果\" /></span></span>";
//echo "<p><span id=\"clip_container\"><span id=\"clip_button\" style=\"border: 1px solid #000000;padding: 3px 3px;font-weight:normal;background: #CCCCFF;font-size:14px;\">复制结果</span></span></p>";
echo "<p><span id=\"clip_container\"><span id=\"clip_button\" class=\"copybutton\">复制结果</span></span></p>";
echo "</td></tr></table>";

//上次计算结果
if (isset($_SESSION['atk'])){
echo "<br>";
echo "<table border=\"0\" cellpadding=\"10\" cellspacing=\"1\" bgcolor=\"black\"><tr><td bgcolor=\"#FFFFCC\">";
echo "<p>上<br>次<br>计<br>算<br>结<br>果</p></td><td bgcolor=\"#FFFFCC\" id=\"result\">";
echo "<p class=\"small\">";
echo "队长倍率 = ".$_SESSION['leader1']." × ".$_SESSION['leader2']."，";
echo "主动技能倍率 = ".$_SESSION['skill']." <br>";
echo "觉醒横排加强数 = ".$_SESSION['jxnum'];
if ($_SESSION['anti'] == 2){
echo "，属性相克<br>";
}
else
{
echo "<br>";
}
echo "珠子排列方式为 ".$_SESSION['orb1'];
for ($i=2;$i<=5;$i++) {
    if ($_SESSION["orb$i"] > 0)
        echo " + ".$_SESSION["orb$i"];
}
echo " ,横排数为".$_SESSION['linenum']."<br>";
if ($_SESSION['damage'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight]$_SESSION[combo]C伤害为 $_SESSION[atk]*$_SESSION[totalmtp]=$_SESSION[damage]</font></b><br>";
}
else
{
echo "<b><font color=#FF0000>$_SESSION[checklight]$_SESSION[combo]C伤害为 $_SESSION[atk]*$_SESSION[totalmtp]=$_SESSION[damage]， 秒杀神王！</font></b><br>";
}

if ($_SESSION['fulldamage'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight]全屏1C伤害为 $_SESSION[atk]*$_SESSION[fullmtp]=$_SESSION[fulldamage]</font></b><br>";
}
else
{
echo "<b><font color=#0000FF>$_SESSION[checklight]全屏1C伤害为 $_SESSION[atk]*$_SESSION[fullmtp]=$_SESSION[fulldamage]， 秒杀神王！</font></b><br>";
}
echo "</p></td></tr></table>";
}

//上上次计算结果

if (isset($_SESSION['atk2'])){
echo "<br>";
echo "<table border=\"0\" cellpadding=\"10\" cellspacing=\"1\" bgcolor=\"black\"><tr><td bgcolor=\"#CCFFCC\">";
echo "<p>上<br>上<br>次<br>计<br>算<br>结<br>果</p></td><td bgcolor=\"#CCFFCC\" id=\"result\">";
echo "<p class=\"small\">";
echo "队长倍率 = ".$_SESSION['leader21']." × ".$_SESSION['leader22']."，";
echo "主动技能倍率 = ".$_SESSION['skill2']." <br>";
echo "觉醒横排加强数 = ".$_SESSION['jxnum2'];
if ($_SESSION['anti2'] == 2){
echo "，属性相克<br>";
}
else
{
echo "<br>";
}
echo "珠子排列方式为 ".$_SESSION['orb21'];
for ($i=2;$i<=5;$i++) {
    if ($_SESSION["orb2$i"] > 0)
        echo " + ".$_SESSION["orb2$i"];
}
echo " ,横排数为".$_SESSION['linenum2']."<br>";
if ($_SESSION['damage2'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight2]$_SESSION[combo2]C伤害为 $_SESSION[atk2]*$_SESSION[totalmtp2]=$_SESSION[damage2]</font></b><br>";
}
else
{
echo "<b><font color=#FF0000>$_SESSION[checklight2]$_SESSION[combo2]C伤害为 $_SESSION[atk2]*$_SESSION[totalmtp2]=$_SESSION[damage2]， 秒杀神王！</font></b><br>";
}

if ($_SESSION['fulldamage2'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight2]全屏1C伤害为 $_SESSION[atk2]*$_SESSION[fullmtp2]=$_SESSION[fulldamage2]</font></b><br>";
}
else
{
echo "<b><font color=#0000FF>$_SESSION[checklight2]全屏1C伤害为 $_SESSION[atk2]*$_SESSION[fullmtp2]=$_SESSION[fulldamage2]， 秒杀神王！</font></b><br>";
}
echo "</p></td></tr></table>";
}

//记录上上次结果
$_SESSION['atk2']=$_SESSION['atk'];
$_SESSION['leader21']=$_SESSION['leader1'];
$_SESSION['leader22']=$_SESSION['leader2'];
$_SESSION['skill2']=$_SESSION['skill'];
$_SESSION['jxnum2']=$_SESSION['jxnum'];
$_SESSION['totalmtp2']=$_SESSION['totalmtp'];
$_SESSION['damage2']=$_SESSION['damage'];
$_SESSION['fullmtp2']=$_SESSION['fullmtp'];
$_SESSION['fulldamage2']=$_SESSION['fulldamage'];
$_SESSION['orb21']=$_SESSION['orb1'];
$_SESSION['orb22']=$_SESSION['orb2'];
$_SESSION['orb23']=$_SESSION['orb3'];
$_SESSION['orb24']=$_SESSION['orb4'];
$_SESSION['orb25']=$_SESSION['orb5'];
$_SESSION['linenum2']=$_SESSION['linenum'];
$_SESSION['checklight2']=$_SESSION['checklight'];
$_SESSION['combo2']=$_SESSION['combo'];
$_SESSION['anti2']=$_SESSION['anti'];

//记录上次结果
$_SESSION['atk']=$atk;
$_SESSION['leader1']=$leader1;
$_SESSION['leader2']=$leader2;
$_SESSION['skill']=$skill;
$_SESSION['jxnum']=$jxnum;
$_SESSION['totalmtp']=$totalmtp;
$_SESSION['damage']=$damage;
$_SESSION['fullmtp']=$fullmtp;
$_SESSION['fulldamage']=$fulldamage;
$_SESSION['orb1']=$orb[1];
$_SESSION['orb2']=$orb[2];
$_SESSION['orb3']=$orb[3];
$_SESSION['orb4']=$orb[4];
$_SESSION['orb5']=$orb[5];
$_SESSION['linenum']=$linenum;
$_SESSION['checklight']=$checklight;
$_SESSION['combo']=$combo;
$_SESSION['anti']=$anti;
}
?>
</div>
<br>
</body>
</html>
