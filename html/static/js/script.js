/** 蓝叶工具箱
 ** 在线影视库
 ** time:2023-11-20
 **/
function Searchvod(){
  var searchKey = $('#searchtext').val();
  if(searchKey == ''){alert('请输入关键词');return false;}
     window.location.href='so-'+searchKey+'.html';
}
$(document).ready(function() {
 if($('.listbox').height() > 100){
    $('.listbox').addClass('closemode'); 
    $('.morelist').show();
 };
 $('.morelist').click(function(){
   if($(this).data('statu') == 0){
	$('.listbox').removeClass('closemode');
    $(this).html('收起列表').data('statu','1');
   }else{
    $('.listbox').addClass('closemode');
    $(this).html('展开列表').data('statu','0');
   }
 });
 
 var videobox = document.getElementById("playbox");
 var videolist = new Array();
  $('.videolist a').each(function(index){
    videolist.push($(this).attr('data-url'));
  });
  $('.videolist a').each(function(index){
    if($(this).attr('data-index') == $('#playbox').attr('data-index')){$(this).addClass('curr');};
  });

if(videobox){
  videobox.addEventListener('ended',function(){	   
       if($('#playbox').attr('data-index') < videolist.length - 1){
		 if(!(navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))){
		 var hls = new Hls();
             hls.loadSource(videolist[Number($('#playbox').attr('data-index')) + Number(1)]);
             hls.attachMedia(videobox);
             hls.on(Hls.Events.MANIFEST_PARSED,function() {
             videobox.play();
          })   
		 }else{
		   $('#playbox').attr('src',videolist[Number($('#playbox').attr('data-index')) + Number(1)]);
		 }
	     $('#playbox').attr('data-index',Number($('#playbox').attr('data-index')) + Number(1));
		 $('.videolist a').removeClass('curr');
		 $('.videolist a').each(function(index){
          if($(this).attr('data-index') == $('#playbox').attr('data-index')){$(this).addClass('curr');};
         });
	   }
   });	
}
  var videourl = $('#playbox').attr('src');
  if(/.m3u8/.test(videourl) && !(navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))){
    var hls = new Hls();
    hls.loadSource(videourl);
    hls.attachMedia(videobox);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
      videobox.play();
	  $('.loadings').hide();
    }) 
  }
  //play css
   $('.videolist a').click(function(){
      $('.videolist a').removeClass('curr');
	  $(this).addClass('curr');
   })
  //closedeng
  $('#close_deng').click(function(){
   if($(this).attr('data-mod') == '0'){
	 $('#menu').addClass('relative');
     $(this).text('开灯').attr('data-mod','1').parent().addClass('fixed').parent().append('<li id="caidan"><a href="javascript:;">秘密</a></li>');;
	 $('#bodybg').fadeIn();
	 $('#playbox').parent().addClass('opendeng');
   }else{
	 $('#menu').removeClass('relative');
     $(this).text('关灯').attr('data-mod','0').parent().removeClass('fixed').parent().find('#caidan').remove();
	 $('#bodybg').fadeOut();
	 $('#playbox').parent().removeClass('opendeng');
   }
  })
 //videofullscreen
 $(document).on('click', '#caidan',function() {
 var marioVideo = document.getElementById("playbox");
     videoFullscreen = document.getElementById("caidan");
	 if (marioVideo.requestFullscreen) {
                marioVideo.requestFullscreen();
            }
            else if (marioVideo.msRequestFullscreen) {
                marioVideo.msRequestFullscreen();
            }
            else if (marioVideo.mozRequestFullScreen) {
                marioVideo.mozRequestFullScreen();
            }
            else if (marioVideo.webkitRequestFullScreen) {
                marioVideo.webkitRequestFullScreen();
            }
  })
  


});
function ViewImg(a, b){
	$('#playModal').css('margin-top','80px');
	$('#playModal .modal-title').text('预览海报');
	$('#playModal .modal-body').html('正在加载中，请稍等......');
	$('#playModal').modal('show');
	setTimeout(function(){
	$.ajax({
      async: false,
      type : "get",
      url : window.location.origin + "/movie/json.php?id="+a+"&t="+b,
      dataType : 'json',
      success : function(data) {
		$('.warning').hide();
		if(typeof(data.img) != 'undefined'){
		  $('#playModal .modal-title').text('正在预览《'+data.title+'》海报');
		  $('#playModal .modal-body').html('<img src="'+data.img+'" style="width:100%;" />');
		}else{
		  $('#playModal').modal('hide');
		  alert('抱歉海报获取失败，请稍后再试！');
		}
	  }
    });
	},1000);
}
function Playfile(){
 var mediaurl = $('#playurl').val();
 if(mediaurl == ''){
  $('#myModal').modal('show');
  return false;	 
 }
 if(/http/.test(mediaurl) == false){
  $('#myModal').modal('show');
  return false;	
 }
 if(/.m3u8/.test(mediaurl) && !(navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))){
 var video = document.getElementById('playbox');
    var hls = new Hls();
    hls.loadSource(mediaurl);
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
      video.play();
  });
 }else{
 $('#playbox').attr('src',mediaurl);
 }
}
function Playm3u8(a){
    var video = document.getElementById('playbox');
	$('#playbox').attr('data-index', $(a).attr('data-index'));
    var hls = new Hls();
    hls.loadSource($(a).attr('data-url'));
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED,function() {
      video.play();
  });
}
window.onbeforeunload = onbeforeunload_handler;function onbeforeunload_handler(){$('.loadwrap').show();};
function dengBtn(a){
  if($(a).attr('data-mode')=='0'){
     $(a).addClass('heideng');
	 $(a).attr('data-mode','1');
	 $(a).text('开灯');
	 $('.bodybg').fadeIn();
	 $('#playbox').addClass('heivideo');
	 $('body').addClass('noscroll');
  }else{
     $(a).removeClass('heideng');
	 $(a).attr('data-mode','0');
	 $(a).text('关灯');
	 $('.bodybg').fadeOut();
	 $('#playbox').removeClass('heivideo');
	 $('body').removeClass('noscroll');
  }
}