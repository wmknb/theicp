<?php
$data = json_decode(file_get_contents("id.json"), true);
$pendingid = json_decode(file_get_contents("pendingid.json"), true);
if(in_array($_GET["id"], $data) || in_array($_GET["id"], $pendingid)) {
	header("Location: ?error=1");
}
?>
<?php
require_once __DIR__ . '/html/head.php'
?>
<body>
<div class="container" id="wrap">
 <div class="row">
 <div class="alert alert-success playtips" role="alert">
 <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <strong>请在这里选择一个您心仪的梵备案号吧</strong>
 </div> 
    <div class="alert alert-info videolist" role="alert">
   <div class="listbox">
<?php
			$data = json_decode(file_get_contents("id.json"), true);
			$year = date("Y");
			$number = [];
				for($j = 0; $j < 10000; $j++) {
					$number[] = $year . sprintf("%04d", $j);
				}
			$perPage = 50;
			$currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
			$totalPages = ceil(count($number) / $perPage);
			$startIndex = ($currentPage - 1) * $perPage;
			$currentPageNumbers = array_slice($number, $startIndex, $perPage);
			$pendingid = json_decode(file_get_contents("pendingid.json"), true);
			foreach($currentPageNumbers as $number) {
				if(!in_array($number, $data) && !in_array($number, $pendingid)) {
					echo "<a href=\"join.php?id=$number\" title=\"确认选择 $number\">$number</a>";
				}
			}
			echo "<div class=\"listbox\">";
			if($currentPage > 1) {
				echo "<p style=\"margin-top: 20px; margin:0 auto;margin-bottome: 20px;\"><a href=\"?page=" . ($currentPage - 1) . "\" class=\"curr\">上一页</a></p>";
			}
			if($currentPage < $totalPages) {
				echo "<p style=\"margin-top: 20px; margin:0 auto;margin-bottome: 20px;\"><a href=\"?page=" . ($currentPage + 1) . "\" class=\"curr\">下一页</a></p></div>";
			}
			?>
           </div>
<div style="margin-top: 20px;"></div>
           <div class="clearfix"></div>
   <div class="morelist" data-statu="0" style="margin-bottome: 20px;">展开列表</div>
   <div style="margin-top: 20px;"></div>
  </div>
    </div>
 </div>
<script src="static/js/script.js"></script>
<div class="bodybg"></div>
<div class="warning"></div>
<div class="loadwrap"><div class="loaderbox"><svg version="1.1" id="loader-1" x="0px" y="0px" width="100px" height="100px" viewbox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"><animatetransform attributetype="xml" attributename="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatcount="indefinite"></animatetransform></path></svg><div class="load-msg">备案号加载中....</div></div></div>
<?php
require_once __DIR__ . '/html/link.php'
?>
<div style="display:none"><?php echo $data["tongji"];?></div>
<?php
require_once __DIR__ . '/html/foot.php'
?>