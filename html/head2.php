<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="referrer" content="never">
<title>ICP备案</title>
<link rel="shortcut icon" href="static/picture/icpba.png">
<script type="text/javascript" src="static/js/jquery.min.js"></script>
<link href="static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="static/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="sty.css">
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<link href="static/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="static/css/style1.css" rel="stylesheet" type="text/css">
<script src="static/js/hls.min.js" type="text/javascript"></script>
<style>
	/**彩色滚动条样式开始*/
::-webkit-scrollbar {
  width: 5px;  
  height: 1px;
}
::-webkit-scrollbar-thumb {
  background-color: #00BB9A;
  background-image: -webkit-linear-gradient(45deg, rgba(255, 93, 143, 1) 25%, transparent 25%, transparent 50%, rgba(255, 93, 143, 1) 50%, rgba(255, 93, 143, 1) 75%, transparent 75%, transparent);
}
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
    background: #f6f6f6;
}
/**彩色滚动条样式结束*/
* {padding: 0;margin: 0;font-family: "微软雅黑";font-size: 14px;}
ul,li {list-style: none;}
a {text-decoration: none;color: black;}
.box{width: 100%;height: 140px;margin: 10px auto;overflow: hidden;position: relative;}
.box-1 ul{}
.box-1 ul li{width: 100%;height: 140px;position: relative;overflow: hidden;}
.box-1 ul li img{display:block;width: 100%; height: 140px;}
.box-1 ul li h2{position: absolute;left: 0;bottom: 0;height: 40px;width:100%;background: rgba(125,125,120,.4);text-indent: 2em;
				padding-right:500px ;font-size: 15px;line-height: 40px;text-overflow: ellipsis;overflow: hidden;
				white-space: nowrap;font-weight: normal;color: ghostwhite}
.box-2{position: absolute;right: 10px;bottom: 14px;}
.box-2 ul li{float:left;width: 12px;height: 12px;overflow: hidden; margin: 0 5px; border-radius: 50%;
				background: rgba(0,0,0,0.5);text-indent: 100px;cursor: pointer;}
.box-2 ul .on{background: rgba(255,255,255,0.6);}
.box-3 span{position: absolute;color: white;background: rgba(125,125,120,.3);width: 50px;height: 80px;
				top:50%; font-family: "宋体";line-height: 80px;font-size:60px;margin-top: -40px;
				text-align: center;cursor: pointer;}
.box-3 .prev{left: 10px;}
.box-3 .next{right: 10px;}
.box-3 span::selection{background: transparent;}
.box-3 span:hover{background: rgba(125,125,120,.8);}
</style>
<script type="text/javascript">
window.onload = function(){
	function $(param){
		if(arguments[1] == true){
			return document.querySelectorAll(param);
		}else{
			return document.querySelector(param);
		}
	}
	var $box = $(".box");
	var $box1 = $(".box-1 ul li",true);
	var $box2 = $(".box-2 ul");
	var $box3 = $(".box-3");
	var $length = $box1.length;
	
	var str = "";
	for(var i =0;i<$length;i++){
		if(i==0){
			str +="<li class='on'>"+(i+1)+"</li>";
		}else{
			str += "<li>"+(i+1)+"</li>";
		}
	}
	$box2.innerHTML = str;
	
	var current = 0;
	
	var timer;
	timer = setInterval(go,1000);
	function go(){
		for(var j =0;j<$length;j++){
			$box1[j].style.display = "none";
			$box2.children[j].className = "";
		}
		if($length == current){
			current = 0;
		}
		$box1[current].style.display = "block";
		$box2.children[current].className = "on";
		current++;
	}
	
	for(var k=0;k<$length;k++){
		$box1[k].onmouseover = function(){
			clearInterval(timer);
		}
		$box1[k].onmouseout = function(){
			timer = setInterval(go,1000);
		}
	}
	for(var p=0;p<$box3.children.length;p++){
		$box3.children[p].onmouseover = function(){
			clearInterval(timer);
		};
		$box3.children[p].onmouseout = function(){
			timer = setInterval(go,1000);
		}
	}
	
	for(var u =0;u<$length;u++){
		$box2.children[u].index  = u;
		$box2.children[u].onmouseover = function(){
			clearInterval(timer);
			for(var j=0;j<$length;j++){
				$box1[j].style.display = "none";
				$box2.children[j].className = "";
			}
			this.className = "on";
			$box1[this.index].style.display = "block";
			current = this.index +1;
		}
		$box2.children[u].onmouseout = function(){
			timer = setInterval(go,1000);
		}
	}
	
	$box3.children[0].onclick = function(){
		back();
	}
	$box3.children[1].onclick = function(){
		go();
	}
	function back(){
		for(var j =0;j<$length;j++){
			$box1[j].style.display = "none";
			$box2.children[j].className = "";
		}
		if(current == 0){
			current = $length;
		}
		$box1[current-1].style.display = "block";
		$box2.children[current-1].className = "on";
		current--;
	}
}
</script>
</head>
<nav class="navbar navbar-default header">
 <div class="container" id="menu">
  <div class="navbar-header">
   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
   <a class="navbar-brand" href="index.php" id="logo" title="<?php echo $title; ?>"><img src="/html/img/1.png" alt="<?php echo $title; ?>" /></a> </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   <ul class="nav navbar-nav navbar-right">
<li><a href="join.php" target="_blank">申请备案</a></li>
<li><a href="../about.php" target="_blank">关于梵备</a></li>
<li><a href="https://wpa.qq.com/msgrd?v=3&uin=1m3589067134&site=qq&menu=yes" target="_blank">联系客服</a></li>
</ul>
  </div>
 </div>
</nav>