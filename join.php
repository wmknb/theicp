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
 <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <strong>备案申请</strong>
 </div> 
  <div class="alert alert-info" role="alert">
<?php
		if($_GET["error"] == 1) {
			echo "<h2 style=\"font-size: 20px;text-align: center;\"><img src=\"static/image/X.png\"><br><p style=\"margin-top: 30px;\">错误的备案ID</h2><p style=\"font-size: 18px;text-align: center;\">该备案号已被注册，请重新选择</p><p style=\"font-size: 18px;text-align: center;\"><a href=\"../id.php\" class=\"btn btn-warning\" target=\"_blank\">点此选择</a></p>";
		} else {
			if(isset($_GET["id"])) {
				if(isset($_GET["step"]) && $_GET["step"] == 2) {
				echo "<div class=\"row\"><form action=\"complete.php\" method=\"POST\">
   <div class=\"input-group\">
     <span class=\"input-group-addon\" id=\"basic-addon1\">备案编号</span>
     <input id=\"holder-size\" type=\"text\" id=\"inputField\" name=\"id\" class=\"form-control\" aria-describedby=\"basic-addon1\" value=\"{$_GET["id"]}\"  maxlength=\"10\" oninput=\"checkMaxLength(event)\" readonly=\"readonly\"/>
   </div>
   <div class=\"input-group\">
     <span class=\"input-group-addon\" id=\"basic-addon2\">网站域名</span>
     <input id=\"holder-background\" type=\"text\" name=\"domain\" class=\"form-control\" placeholder=\"请输入你的网站域名,不要带http://\" aria-describedby=\"basic-addon2\"/>
   </div>
      <div class=\"input-group\">
     <span class=\"input-group-addon\" id=\"basic-addon2\">主体类型</span>
<select class=\"form-control\" aria-label=\"单位性质\" name=\"type\">
                             <option value=\"个人\">个人</option>
                            <option value=\"企业\">企业</option>
</select> 

   </div>
   <div class=\"input-group\">
     <span class=\"input-group-addon\" id=\"basic-addon2\">网站名称</span>
     <input id=\"holder-background\" type=\"text\" name=\"webname\" class=\"form-control\" placeholder=\"请输入你的网站名称\" aria-describedby=\"basic-addon2\"/>
   </div>
   <div class=\"input-group\">
     <span class=\"input-group-addon\" id=\"basic-addon3\">网站介绍</span>
     <input id=\"holder-fontcolor\" type=\"text\" name=\"description\" class=\"form-control\" placeholder=\"请简单介绍你的网站\" aria-describedby=\"basic-addon3\" />
   </div>
   <div class=\"input-group\">
     <span class=\"input-group-addon\" id=\"basic-addon4\">网站站主</span>
     <input id=\"holder-font\" type=\"text\" name=\"master\" class=\"form-control\" placeholder=\"请输入你的名字或昵称\" aria-describedby=\"basic-addon4\"/>
   </div>
   <div class=\"input-group\">
     <span class=\"input-group-addon\" id=\"basic-addon5\">联系邮箱</span>
     <input id=\"holder-imgurl\" type=\"text\" name=\"email\" class=\"form-control\" placeholder=\"请输入你的联系邮箱\" aria-describedby=\"basic-addon5\" />
   </div> 
  <div class=\"input-group\">

                                    <small class=\"input-group-addon\">
                                        <label class=\"checkbox\">
                                        <input required type=\"checkbox\" name=\"igree\" id=\"igree\" style=\"display:inline;\"><span></span> 我已阅读并同意<a class=\"btn-link\" href=\"#\" data-toggle=\"modal\" data-target=\"#modal-terms\">用户协议</a>和<a class=\"btn-link\" href=\"/\">隐私政策</a>
                                        </label>
                                        
                                    </small>
                                </div>
   <div class=\"btn-wrap\">
   <button type=\"submit\" class=\"btn btn-success\" onclick=\"updateHolder();\">提交备案</button><form></div>";
				} else {
					echo "<h2 style=\"float-right: 20px;\">添加备案代码</h2><p>请及时在贵站的全站页脚文件添加如下代码后，点击下方继续完成申请</p><p>
					   <p style=\"margin-top:20px;\">&lt;img style=&quot;width:20px;height:20px;&quot; src=&quot;https://icp.18z.fun/static/picture/icpba.png&quot;&gt;&lt;a href=&quot;https://icp.18z.fun/?id={$_GET["id"]}&quot; target=&quot;_blank&quot;&gt;{$_GET["id"]}号&lt;/a&gt;</p><p style=\"margin-top:20px;\"><button class=\"btn btn-warning\" onclick=\"window.location.href='?id={$_GET["id"]}&step=2'\">我已添加，继续完成申请</button></p>";
				}
			} else {
				echo "<h2 class=\"mdui-typo-display-1 mdui-m-l-2\">$title 申请</h2><h2 class=\"mdui-typo-headline mdui-m-l-3\">申请前你需要知悉的：</h2><p><big>一、梵备案申请约花费2分钟，审核约花费1-3个工作日，请空闲时申请。<br>

二、网站的内容不涉及商业、政治、色情、灰色、版权、破解、企业类。<br>

三、非空壳类网站，能长期存活和更新及无违反道德公序良俗的个人网站。<br>

四、已启用安全的HTTPS连接会按要求完成与梵ICP备案系统正确的代码对接。<br>

五、审核通过请把备案信息调用代码正确放置在贵站的页脚明显的位置。</big></p><p style=\"margin-top:20px;\"><button class=\"btn btn-success\" onclick=\"window.location.href='id.php'\">Got it, let's start selecting numbers</button></p>";
			}
		}
		?>
   </div>
    </div>
 </div>
<?php
require_once __DIR__ . '/html/link.php'
?>
<?php
require_once __DIR__ . '/html/foot.php'
?>