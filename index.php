<?php
require_once __DIR__ . '/html/head2.php'
?>
<body>

<div class="container" id="wrap"> <div class="row"> <div class="alert alert-danger playtips" role="alert">
🔉 <strong>某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某某</strong>
  </div> 
<div class="container" id="wrap"> <div class="row"> <div class="alert alert-success playtips" role="alert">
<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <?php if($_GET['id']){?>虚拟备案编号 《<?php echo $_GET['id'] ?>》 的结果如下<?php }else{?>请输入备案编号查询备案信息<?php }?><strong></strong>
  </div> 
 <div class="alert alert-info" role="alert">
    <form action="/" method="GET">
    <div class="input-group">
      <input  type="text" name="id" id="searchtext" class="form-control" placeholder="请输入备案编号进行查询..." value="<?php echo $_GET["wd"]; ?>">
      <span class="input-group-btn">
          <button style="background-color: #37c8e5;" type="submit" id="searchbtn">立即查询</button>
      </span>
    </div>
    </form>
<div class="input-group hotlist">
⚠请确保您的编号存在，否则将会差不到您自己的编号
	</div>
  </div>
<?php
			function searchArray($array, $value) {
				$results = [];
				foreach($array as $key => $item) {
					if($item === $value) {
						$results[] = $array;
					} else if(is_array($item)) {
						$subResults = searchArray($item, $value);
						if(!empty($subResults)) {
							$results = array_merge($results, $subResults);
						}
					}
				}
				return $results;
			}
			$info = json_decode(file_get_contents("idinfo.json"), true);
			if(!empty($_GET["id"])) {
				$id = json_decode(file_get_contents("id.json"), true);
				$pendingid = json_decode(file_get_contents("pendingid.json"), true);
				if(in_array($_GET["id"], $id)) {
					$array = searchArray($info, $_GET["id"]);
					
					
					echo "<table class='table'><thead><tr><th>查询结果：</th></tr></thead><tbody>
					<tr><td><p>备案号：某{$_GET["id"]}号</p><p>网站域名：<a style=\"display:inline-block;text-decoration:none;\" href=\"http://{$array[0]["domain"]}\" target=\"_blank\">{$array[0]["domain"]}</a></p><p>主体类型：{$array[0]["type"]}</p><p>网站名称：{$array[0]["webname"]}</p><p>网站介绍：{$array[0]["description"]}</p><p>网站站长：{$array[0]["master"]}</p><p>联系邮箱：{$array[0]["email"]}</p></td></tr></tbody></table>";	
				} else if(in_array($_GET["id"], $pendingid)) {
					echo "<table class=\"table\"><thead><tr><th>查询结果：</th></tr></thead><tbody><tr><td><p>备案编号：<font color='blue'>{$_GET["id"]}</font> 正在审核中</p></td></tr></tbody></table>";
				} else {
					echo "<table class='table'><thead><tr><th>查询结果：</th></tr></thead><tbody><tr><td><p>备案编号：<font color='red'>{$_GET["id"]}</font> 的备案信息不存在，<a href='join.php?id={$_GET["id"]}' style='display:inline-block;text-decoration:none;height:20px;line-height:20px;'>点此拥有TA吧</a></p></td></tr></tbody></table>";
				}
			}
			?>
 </div>
 <?php
require_once __DIR__ . '/html/link.php'
?>
</div>
</div>
<div id="web_bg"><img src="static/picture/bg.png"></div>
</div></div></div>
<script src="static/js/canvas-nest.min.js"></script>
<script src="static/js/script.js"></script>
</body>
</html>