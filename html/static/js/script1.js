$(function(){
  $('.playtips').click(function(e) {
    document.getElementById('audiotips').play();   
 });
 $('#playModal').on('hidden.bs.modal'); 
});
document.oncontextmenu = function() {return false;};
function Copycode(a){var contentstr=document.getElementById(a);contentstr.select();document.execCommand("Copy");}