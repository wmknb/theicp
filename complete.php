<?php
if(!empty($_POST["id"]) && !empty($_POST["domain"]) && !empty($_POST["description"]) && !empty($_POST["type"]) && !empty($_POST["master"]) && !empty($_POST["email"]) && !empty($_POST["webname"]) ) {
	$data = json_decode(file_get_contents("id.json"), true);
	$pendingid = json_decode(file_get_contents("pendingid.json"), true);
	if(!in_array($_POST["id"], $data) && !in_array($_POST["id"], $pendingid)) {
		$pendingid[] = $_POST["id"];
		file_put_contents("pendingid.json", json_encode($pendingid));
		$data = json_decode(file_get_contents("pending.json"), true);
		$data[] = array("id" => $_POST["id"], "domain" => $_POST["domain"], "description" => $_POST["description"], "type" => $_POST["type"], "master" => $_POST["master"], "email" => $_POST["email"], "webname" => $_POST["webname"]);
		file_put_contents("pending.json", json_encode($data));
		header("Location: index.php?id={$_POST["id"]}");
	} else {
		header("Location: join.php?error=1");
		echo "<center><h1><!doctype html>
<html lang='zh-cn'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>抱歉：您的申请的备案号已存在</title>
    <link rel='icon' type='image/png' href='/favicon.ico'>
    <link rel='stylesheet' href='//img-cdn.18z.fun/css/css2.css?family=Inter:wght@400;500;600;700&display=swap'>
    <link rel='stylesheet' href='//img-cdn.18z.fun/css/style.tailwind.css'>
    <script src='https://cdn.bootcss.com/jquery/1.11.1/jquery.min.js'></script>
</head>
<body>
<div id='page-container' class='flex flex-col mx-auto w-full min-h-screen min-w-80 bg-white text-gray-800 '>
    <main id='page-content' class='flex flex-auto flex-col max-w-full bg-gray-50'>
        <div class='flex-grow flex flex-col items-center justify-center bg-white overflow-hidden'>
            <div class='flex-none container xl:max-w-6xl mx-auto p-8 text-center'>
                <a class='group inline-flex items-center space-x-1 font-bold text-lg text-gray-700' href='/'>
                    <img src='static/picture/logo-icp.png' alt='Nathan_Auth' style='width: 200.8px; height: 100%;' draggable='false' onerror='onerror=null;'>
                </a>
            </div>
            <div class='flex-grow flex items-center justify-center'>
                <div class='group relative px-4 lg:px-8'>
                    <div class='absolute inset-0 -m-16 bg-indigo-100 rounded-3xl transform -rotate-2 translate-y-1 scale-105 transition ease-out duration-500 group-hover:-rotate-1'>
                    </div>
                    <div class='absolute inset-0 -m-16 bg-brand-100 rounded-3xl transform rotate-2 translate-y-1 scale-105 transition ease-out duration-500 group-hover:rotate-1'>
                    </div>
                    <div class='absolute inset-0 -m-16 bg-white rounded-md shadow-subtle'>
                    </div>
                    <div class='relative'>
                        <div>
                            <div class='mb-8 text-center'>
                                <div class='mb-5 text-red-500'>
                                    <svg class='fa-duo fa-exclamation-triagle inline-block w-20 h-20' fill='currentColor' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' width='100' height='100'><path d='M569.52 440L329.58 24c-18.44-32-64.69-32-83.16 0L6.48 440c-18.42 31.94 4.64 72 41.57 72h479.89c36.87 0 60.06-40 41.58-72zM288 448a32 32 0 1132-32 32 32 0 01-32 32zm38.24-238.41l-12.8 128A16 16 0 01297.52 352h-19a16 16 0 01-15.92-14.41l-12.8-128A16 16 0 01265.68 192h44.64a16 16 0 0115.92 17.59z' opacity='.4'/><path d='M310.32 192h-44.64a16 16 0 00-15.92 17.59l12.8 128A16 16 0 00278.48 352h19a16 16 0 0015.92-14.41l12.8-128A16 16 0 00310.32 192zM288 384a32 32 0 1032 32 32 32 0 00-32-32z' class='fa-primary'/></svg>
                                </div>
                                <h1 class='text-2xl font-bold mb-1'>
                                    抱歉：您的申请的备案号已存在！
                                </h1>
                            </div>
                        </div>
                        <div class='text-center space-x-1 sm:space-x-2'>
                             <a href='/join.php' target='_blank' class='inline-flex justify-center items-center space-x-2 rounded border font-medium focus:outline-none px-4 py-2 leading-6 border-brand-700 bg-brand-700 text-white hover:text-white hover:bg-brand-800 hover:border-brand-800 focus:ring focus:ring-brand-500 focus:ring-opacity-50 active:bg-brand-700'>
                                <span>系统在 <span id='wait'>3</span> 秒后跳转</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class='flex-none container xl:max-w-6xl mx-auto p-8 text-center text-sm'>
                Copyright &copy; 2024. <strong>梵ICP备案系统</strong> All rights reserved.
            </div>
        </div>
    </main>
</div>
	<script type='text/javascript'>
		(function () {
			var wait = $('#wait'), href = '/join.php';
			var time = parseInt(wait.text());
			var interval = setInterval(function () {
				time = time - 1;
				wait.text(time);
				if (time <= 0) {
					location.href = href;
					clearInterval(interval);
				}
			}, 1000);
		})();
	</script>
</body>
</html></h1></center>";
	}
} else {
	echo "<!doctype html>
<html lang='zh-cn'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>抱歉：您的信息填写不完整</title>
    <link rel='icon' type='image/png' href='favicon.ico'>
    <link rel='stylesheet' href='//img-cdn.18z.fun/css/css2.css?family=Inter:wght@400;500;600;700&display=swap'>
    <link rel='stylesheet' href='//img-cdn.18z.fun/css/style.tailwind.css'>
    <script src='https://cdn.bootcss.com/jquery/1.11.1/jquery.min.js'></script>
</head>
<body>
<div id='page-container' class='flex flex-col mx-auto w-full min-h-screen min-w-80 bg-white text-gray-800 '>
    <main id='page-content' class='flex flex-auto flex-col max-w-full bg-gray-50'>
        <div class='flex-grow flex flex-col items-center justify-center bg-white overflow-hidden'>
            <div class='flex-none container xl:max-w-6xl mx-auto p-8 text-center'>
                <a class='group inline-flex items-center space-x-1 font-bold text-lg text-gray-700' href='/'>
                    <img src='static/picture/logo-icp.png' alt='Nathan_Auth' style='width: 150.8px; height: 100%;' draggable='false' onerror='onerror=null;'>
                </a>
            </div>
            <div class='flex-grow flex items-center justify-center'>
                <div class='group relative px-4 lg:px-8'>
                    <div class='absolute inset-0 -m-16 bg-indigo-100 rounded-3xl transform -rotate-2 translate-y-1 scale-105 transition ease-out duration-500 group-hover:-rotate-1'>
                    </div>
                    <div class='absolute inset-0 -m-16 bg-brand-100 rounded-3xl transform rotate-2 translate-y-1 scale-105 transition ease-out duration-500 group-hover:rotate-1'>
                    </div>
                    <div class='absolute inset-0 -m-16 bg-white rounded-md shadow-subtle'>
                    </div>
                    <div class='relative'>
                        <div>
                            <div class='mb-8 text-center'>
                                <div class='mb-5 text-red-500'>
                                    <svg class='fa-duo fa-exclamation-triagle inline-block w-20 h-20' fill='currentColor' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' width='100' height='100'><path d='M569.52 440L329.58 24c-18.44-32-64.69-32-83.16 0L6.48 440c-18.42 31.94 4.64 72 41.57 72h479.89c36.87 0 60.06-40 41.58-72zM288 448a32 32 0 1132-32 32 32 0 01-32 32zm38.24-238.41l-12.8 128A16 16 0 01297.52 352h-19a16 16 0 01-15.92-14.41l-12.8-128A16 16 0 01265.68 192h44.64a16 16 0 0115.92 17.59z' opacity='.4'/><path d='M310.32 192h-44.64a16 16 0 00-15.92 17.59l12.8 128A16 16 0 00278.48 352h19a16 16 0 0015.92-14.41l12.8-128A16 16 0 00310.32 192zM288 384a32 32 0 1032 32 32 32 0 00-32-32z' class='fa-primary'/></svg>
                                </div>
                                <h1 class='text-2xl font-bold mb-1'>
                                    抱歉：您的信息填写不完整！
                                </h1>
                            </div>
                        </div>
                        <div class='text-center space-x-1 sm:space-x-2'>
                             <a href='/join.php' target='_blank' class='inline-flex justify-center items-center space-x-2 rounded border font-medium focus:outline-none px-4 py-2 leading-6 border-brand-700 bg-brand-700 text-white hover:text-white hover:bg-brand-800 hover:border-brand-800 focus:ring focus:ring-brand-500 focus:ring-opacity-50 active:bg-brand-700'>
                                <span>系统在 <span id='wait'>3</span> 秒后跳转</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class='flex-none container xl:max-w-6xl mx-auto p-8 text-center text-sm'>
                Copyright &copy; 2024. <strong>ICP备案系统</strong> All rights reserved.
            </div>
        </div>
    </main>
</div>
	<script type='text/javascript'>
		(function () {
			var wait = $('#wait'), href = '/join.php';
			var time = parseInt(wait.text());
			var interval = setInterval(function () {
				time = time - 1;
				wait.text(time);
				if (time <= 0) {
					location.href = href;
					clearInterval(interval);
				}
			}, 1000);
		})();
	</script>
</body>
</html>";
}