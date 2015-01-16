
$( document ).ready(function() {
$( "#UserPass" ).click(function() {
var chk = $("#UserPass").is(':checked');
if(chk==true){
    $('#chngpass').css({'display':'block'});
}else{
    $('#chngpass').css({'display':'none'});
}
});
});