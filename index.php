<?php
session_start();
$apkver="7.9.2";
$apkfile="pad792.apk";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>pad calculator</title>
<meta name="Keywords" content="智龙迷城，伤害计算器" />
<meta name="Description" content="" />
<meta name="Version" content="20140607-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="/jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function(){
  $("img").click(function(){
   if ($(this).attr("src")=="awokenskill-2ucolor.png"){
    $(this).attr("src","awokenskill-2ugrey.png");
    $(this).siblings("input").attr("value",function(i,origValue){
       return (parseInt(origValue) - 1); 
       });
     }
   else {
    $(this).attr("src","awokenskill-2ucolor.png");
    $(this).siblings("input").attr("value",function(i,origValue){
       return (parseInt(origValue) + 1); 
       });
     };
  });

 $("#reset").click(function(){
   $("input[name='skill']").val(1);
   $("input[type='checkbox']").removeAttr('checked');
   $("input[name^='monsteratk']").val(0);
   $("input[type='hidden']").attr("value",0);
   $("img").attr("src","awokenskill-2ugrey.png");
  for(var i=0;i<=11;i++)
   { 
    $("select").get(i).selectedIndex = 0;
   }
 });

});
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
<body>
<div align="center">
<table border="0" cellpadding="10" cellspacing="0" bgcolor="black"><tr><td bgcolor="#FFFFFF">
<form id="cal" name="cal" action="" onsubmit="return orbcheck()" method="post">
<p class="big">
    队长倍率:
 <select name="leader1" >
<?php
   $leadermtp=array(1,1.35,1.5,2,2.5,3,3.15,3.3,3.5,4,4.25,4.5,5,5.5,6,6.75,7,8,9,10,11,12,13,14,15);
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
   $skillmtp=array(1,1.15,1.2,1.3,1.5,2,2.5,3);
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
 <select name="jxrownum" >  
<?php
    for ($i=0;$i<=18;$i++){
	if (isset($_POST['jxrownum']) && $_POST['jxrownum'] == $i) {
	echo "<option value=\"".$_POST['jxrownum']."\" selected>".$_POST['jxrownum']."</option>\n";	
	}
	else
	echo "   <option value=\"$i\">$i</option>\n";
    }
?>
 </select>

    <br>觉醒加珠数(点灯时有效):
 <select name="jxplusnum" >  
<?php
    for ($i=0;$i<=18;$i++){
	if (isset($_POST['jxplusnum']) && $_POST['jxplusnum'] == $i) {
	echo "<option value=\"".$_POST['jxplusnum']."\" selected>".$_POST['jxplusnum']."</option>\n";	
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

    <br>属性相克:
    <input type="checkbox" id="anti" name="anti" value="2"/ <?php if (isset($_POST['anti']) && $_POST['anti']=='2') echo 'checked'; ?> />
    <span>　</span>点灯:
    <input type="checkbox" id="light" name="light" value="1"/ <?php if (isset($_POST['light']) && $_POST['light']=='1') echo 'checked'; ?> />
    <span>　</span>
    <input type="submit" name="submit" value="计算" />
    <input type="button" id="reset" value="重置" />

    <br>
<table cellspacing=1 cellpadding=1 width=100% height=200 border=0  bgcolor="000000">
  <tr align="center">
    <td width="10%" bgcolor="FFFFFF">宠物</td>
    <td bgcolor="FFFFFF">1号位</td>
    <td bgcolor="FFFFFF">2号位</td>
    <td bgcolor="FFFFFF">3号位</td>
    <td bgcolor="FFFFFF">4号位</td>
    <td bgcolor="FFFFFF">5号位</td>
    <td bgcolor="FFFFFF">6号位</td>
  </tr>

  <tr align="center">
    <td bgcolor="FFFFFF">攻击力</td>
<?php
    for ($i=1;$i<=6;$i++){
        echo "<td width=\"15%\" bgcolor=\"FFFFFF\"><input type=\"text\" id=\"monsteratk".$i."\" name=\"monsteratk".$i."\" value=\"".(isset($_POST['monsteratk'.$i])?$_POST['monsteratk'.$i]:0)."\" size=\"5\" style=\"width:50px\" maxlength=\"5\" /></td>";
    }  
?>
  </tr>
  
  <tr align="center">
    <td  bgcolor="FFFFFF">二体觉醒</td>
<?php
    for ($i=1;$i<=6;$i++){
        echo "<td bgcolor=\"FFFFFF\">\n";
        if (isset($_POST['u'.$i])) {
         switch ($_POST['u'.$i]){
          case 0; 
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          break;
          case 1; 
          echo "<img src=\"awokenskill-2ucolor.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          break;
          case 2; 
          echo "<img src=\"awokenskill-2ucolor.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ucolor.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          break;
          case 3; 
          echo "<img src=\"awokenskill-2ucolor.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ucolor.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ucolor.png\"></img><br>\n";
          break;
         }
        }
        else {
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";
          echo "<img src=\"awokenskill-2ugrey.png\"></img><br>\n";       
        }
        echo "<input type=\"hidden\" id=\"u".$i."\" name=\"u".$i."\"  value=\"".(isset($_POST['u'.$i])?$_POST['u'.$i]:0)."\" size=\"5\" maxlength=\"5\"/>\n";
        echo "</td>\n";
    }
?>
  </tr>


<?php

//定义提交的各种参数
if (isset($_POST['leader1'])) {
	$leader1=$_POST['leader1'];
}

if (isset($_POST['leader2'])) {
	$leader2=$_POST['leader2'];
}

if (isset($_POST['skill'])) {
	$skill=$_POST['skill'];
}

if (isset($_POST['jxrownum'])) {
	$jxrownum=$_POST['jxrownum'];
}

if (isset($_POST['jxplusnum'])) {
	$jxplusnum=$_POST['jxplusnum'];
}

if (isset($_POST['combo'])) {
	$combo=$_POST['combo'];
}

for ($i=1;$i<=5;$i++) {
 if (isset($_POST['orb'.$i])) {
	$orb[$i]=intval($_POST['orb'.$i])>0?intval($_POST['orb'.$i]):0;
 }
}

for ($i=1;$i<=6;$i++) {
  if (isset($_POST['u'.$i])) {
	$u[$i]=intval($_POST['u'.$i])>=0?intval($_POST['u'.$i]):0;
  }
}

if (isset($_POST['linenum'])) {
	$linenum=intval($_POST['linenum']);
}

for ($i=1;$i<=6;$i++) {
  if (isset($_POST['monsteratk'.$i])) {
	$monsteratk[$i]=intval($_POST['monsteratk'.$i]);
  }
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


//计算伤害过程

if ($light == 0){
	$plusnum=0;
}
else {
	$plusnum=$jxplusnum;
}

for ($i=1;$i<=5;$i++) {
	$hpnum[$i]=$linenum;
}


for ($n=1;$n<=6;$n++) {
  for ($i=1;$i<=5;$i++) {
	if ($orb[$i] < 3 ){
		$mtp[$i]=0;
	}
	elseif ($orb[$i] == 4 ){
        $mtp[$i]=(1+0.25*($orb[$i]-3))*(1+0.1*$jxrownum*$hpnum[$i])*(1+0.06*$orb[$i]*$light)*(1+0.05*$plusnum)*pow(1.5,$u[$n])*$skill*$leader*(1+0.25*($combo-1))*$anti;
	}
	else 
	$mtp[$i]=(1+0.25*($orb[$i]-3))*(1+0.1*$jxrownum*$hpnum[$i])*(1+0.06*$orb[$i]*$light)*(1+0.05*$plusnum)*$skill*$leader*(1+0.25*($combo-1))*$anti;
  }
  $monstermtp[$n]=array_sum($mtp);
}

for ($n=1;$n<=6;$n++) {
  $monsterdamage[$n]=round($monstermtp[$n]*$monsteratk[$n]);
}

$totaldamage=array_sum($monsterdamage);
$fullmtp=7.75*(1+$light*1.8)*(1+0.1*$jxrownum)*(1+0.05*$plusnum)*$skill*$leader*$anti;
$totalatk=array_sum($monsteratk);
$fulldamage=round($totalatk*$fullmtp);

//补充计算结果到表格下端
echo  "<tr align=\"center\">";
echo  "<td bgcolor=\"FFFFFF\">伤害值</td>";
    for ($i=1;$i<=6;$i++){
        echo "<td bgcolor=\"FFFFFF\">\n";
        echo (isset($monsterdamage[$i])?$monsterdamage[$i]:0);
        echo "</td>\n";
    }
echo  "</tr>";

echo  "<tr align=\"center\">";
echo  "<td bgcolor=\"FFFFFF\">总伤害值</td>";
echo  "<td bgcolor=\"FFFFFF\" colspan=\"6\"><b>".(isset($totaldamage)?$totaldamage:0)."</b></td>";
echo  "</tr>";
}
?>

</table>
    <br><a href="http://www.padcal.com/rowenhanced.jpg" target="_blank">横排强化排珠图</a>  <span>　</span> 
    <a href="http://www.padcal.com/twopronged.jpg" target="_blank">二体攻击排珠图</a>  <span>　</span> 
    <a href="http://www.padcal.com/heroicgod.jpg" target="_blank">英雄神排珠图</a>  <span>　</span> 
    <br><a href="http://www.padcal.com/highcombo.jpg" target="_blank">高combo排珠图</a>  <span>　</span> 
    <a href="http://www.padcal.com/<?=$apkfile;?>" target="_blank">安卓<?=$apkver;?>版安装包</a>  <span>　</span> <a href="http://tieba.baidu.com/p/3031717987" target="_blank">给我留言</a>
  </p>
</form>
  </td></tr></table>

<?php
//显示第一次计算结果//
if (isset($_POST['leader1'])) {
echo "<div align=\"center\">";
echo "<table border=\"0\" cellpadding=\"10\" cellspacing=\"1\" bgcolor=\"black\" ><tr><td bgcolor=\"#F0F8FF\">";
echo "<p>本<br>次<br>计<br>算<br>结<br>果</p></td><td bgcolor=\"#F0F8FF\" >";
echo "<div id=\"result\"><p style=\"display:none;\">";
echo "以下结果来自www.padcal.com<br>";
echo "</p>";
echo "<p class=\"small\">";
echo "队长倍率 = $leader1 × $leader2 ";
echo "，主动技能倍率 = $skill <br>";
echo "觉醒横排加强数 = $jxrownum ";
echo "，觉醒加珠数 = $jxplusnum <br>";
if ($anti == 2){
echo "属性相克<br>";
}
echo "珠子排列方式为 ".$orb[1];
for ($i=2;$i<=5;$i++) {
    if ($orb[$i] > 0) 	
	echo " + ".$orb[$i];
}
echo "，横排数为${linenum}<br>";

switch ($light)
{
case 0:
$checklight="";
break;
case 1:
$checklight="点灯时";
break;
}


if ($totaldamage < 5350000)
{
echo "<b><font color=#000000>${checklight}${combo}C伤害为 ${totaldamage}</font></b><br>";
}
else
{
echo "<b><font color=#FF0000>${checklight}${combo}C伤害为 ${totaldamage}， 秒杀神王！</font></b><br>";
}

if ($fulldamage < 5350000)
{
echo "<b><font color=#000000>${checklight}全屏1C伤害为 <b>$totalatk*$fullmtp=${fulldamage}</font></b><br>";
}
else
{
echo "<b><font color=#0000FF>${checklight}全屏1C伤害为 $totalatk*$fullmtp=${fulldamage}， 秒杀神王！</font></b><br>";
}
echo "</p></div>";
//echo "<span id=\"clip_container\"><span id=\"clip_button\"><input type=\"button\" name=\"button\" value=\"复制结果\" /></span></span>";
//echo "<p><span id=\"clip_container\"><span id=\"clip_button\" style=\"border: 1px solid #000000;padding: 3px 3px;font-weight:normal;background: #CCCCFF;font-size:14px;\">复制结果</span></span></p>";
//echo "<p><span id=\"clip_container\"><span id=\"clip_button\" class=\"copybutton\">复制结果</span></span></p>";
echo "</td></tr></table>";

//上次计算结果
if (isset($_SESSION['totalatk'])){
echo "<br>";
echo "<table border=\"0\" cellpadding=\"10\" cellspacing=\"1\" bgcolor=\"black\"><tr><td bgcolor=\"#FFFFCC\">";
echo "<p>上<br>次<br>计<br>算<br>结<br>果</p></td><td bgcolor=\"#FFFFCC\" id=\"result\">";
echo "<p class=\"small\">";
echo "队长倍率 = ".$_SESSION['leader1']." × ".$_SESSION['leader2']."，";
echo "主动技能倍率 = ".$_SESSION['skill']." <br>";
echo "觉醒横排加强数 = ".$_SESSION['jxrownum']."，";
echo "觉醒加珠数 = ".$_SESSION['jxplusnum'];
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
if ($_SESSION['totaldamage'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight]$_SESSION[combo]C伤害为 $_SESSION[totaldamage]</font></b><br>";
}
else
{
echo "<b><font color=#FF0000>$_SESSION[checklight]$_SESSION[combo]C伤害为 $_SESSION[totaldamage]， 秒杀神王！</font></b><br>";
}

if ($_SESSION['fulldamage'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight]全屏1C伤害为 $_SESSION[totalatk]*$_SESSION[fullmtp]=$_SESSION[fulldamage]</font></b><br>";
}
else
{
echo "<b><font color=#0000FF>$_SESSION[checklight]全屏1C伤害为 $_SESSION[totalatk]*$_SESSION[fullmtp]=$_SESSION[fulldamage]， 秒杀神王！</font></b><br>";
}
echo "</p></td></tr></table>";
}

//上上次计算结果

if (isset($_SESSION['totalatk2'])){
echo "<br>";
echo "<table border=\"0\" cellpadding=\"10\" cellspacing=\"1\" bgcolor=\"black\"><tr><td bgcolor=\"#CCFFCC\">";
echo "<p>上<br>上<br>次<br>计<br>算<br>结<br>果</p></td><td bgcolor=\"#CCFFCC\" id=\"result\">";
echo "<p class=\"small\">";
echo "队长倍率 = ".$_SESSION['leader21']." × ".$_SESSION['leader22']."，";
echo "主动技能倍率 = ".$_SESSION['skill2']." <br>";
echo "觉醒横排加强数 = ".$_SESSION['jxrownum2']."，";
echo "觉醒加珠数 = ".$_SESSION['jxplusnum2'];
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
if ($_SESSION['totaldamage2'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight2]$_SESSION[combo2]C伤害为 $_SESSION[totaldamage2]</font></b><br>";
}
else
{
echo "<b><font color=#FF0000>$_SESSION[checklight2]$_SESSION[combo2]C伤害为 $_SESSION[totaldamage2]， 秒杀神王！</font></b><br>";
}

if ($_SESSION['fulldamage2'] < 5350000)
{
echo "<b><font color=#000000>$_SESSION[checklight2]全屏1C伤害为 $_SESSION[totalatk2]*$_SESSION[fullmtp2]=$_SESSION[fulldamage2]</font></b><br>";
}
else
{
echo "<b><font color=#0000FF>$_SESSION[checklight2]全屏1C伤害为 $_SESSION[totalatk2]*$_SESSION[fullmtp2]=$_SESSION[fulldamage2]， 秒杀神王！</font></b><br>";
}
echo "</p></td></tr></table>";
}

//记录上上次结果
if (isset($_SESSION['totalatk'])) {
	$_SESSION['totalatk2']=$_SESSION['totalatk'];
}

if (isset($_SESSION['leader1'])) {
	$_SESSION['leader21']=$_SESSION['leader1'];
}

if (isset($_SESSION['leader2'])) {
	$_SESSION['leader22']=$_SESSION['leader2'];
}

if (isset($_SESSION['skill'])) {
	$_SESSION['skill2']=$_SESSION['skill'];
}

if (isset($_SESSION['jxrownum'])) {
	$_SESSION['jxrownum2']=$_SESSION['jxrownum'];
}

if (isset($_SESSION['jxplusnum'])) {
	$_SESSION['jxplusnum2']=$_SESSION['jxplusnum'];
}

if (isset($_SESSION['totaldamage'])) {
	$_SESSION['totaldamage2']=$_SESSION['totaldamage'];
}

if (isset($_SESSION['fullmtp'])) {
	$_SESSION['fullmtp2']=$_SESSION['fullmtp'];
}

if (isset($_SESSION['fulldamage'])) {
	$_SESSION['fulldamage2']=$_SESSION['fulldamage'];
}

if (isset($_SESSION['orb1'])) {
	$_SESSION['orb21']=$_SESSION['orb1'];
}

if (isset($_SESSION['orb2'])) {
	$_SESSION['orb22']=$_SESSION['orb2'];
}

if (isset($_SESSION['orb3'])) {
	$_SESSION['orb23']=$_SESSION['orb3'];
}

if (isset($_SESSION['orb4'])) {
	$_SESSION['orb24']=$_SESSION['orb4'];
}

if (isset($_SESSION['orb5'])) {
	$_SESSION['orb25']=$_SESSION['orb5'];
}

if (isset($_SESSION['linenum'])) {
	$_SESSION['linenum2']=$_SESSION['linenum'];
}

if (isset($_SESSION['checklight'])) {
	$_SESSION['checklight2']=$_SESSION['checklight'];
}

if (isset($_SESSION['combo'])) {
	$_SESSION['combo2']=$_SESSION['combo'];
}

if (isset($_SESSION['anti'])) {
	$_SESSION['anti2']=$_SESSION['anti'];
}


//记录上次结果
$_SESSION['totalatk']=$totalatk;
$_SESSION['leader1']=$leader1;
$_SESSION['leader2']=$leader2;
$_SESSION['skill']=$skill;
$_SESSION['jxrownum']=$jxrownum;
$_SESSION['jxplusnum']=$jxplusnum;
$_SESSION['totaldamage']=$totaldamage;
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
