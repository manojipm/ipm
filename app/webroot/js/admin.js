//////////////////////////////////////////////////////////////////
function active(host, dataId, forModel=""){
	//alert(host);
						
	var src = $("#"+dataId).attr("src");
	
	var name = src.lastIndexOf('/');
	var newImgName = src.substr(name+1);
	var stat = '';
	var changesrc = '';
	if(newImgName == 'inactive.png'){
		stat = 1;
		msg = "Are you sure you want to activate?";
		changesrc = src.replace("inactive", "active"); 
	}else{
		stat = 0;
		msg = "Are you sure you want to deactivate?";
		changesrc = src.replace("active", "inactive");
	}
	//alert(changesrc);
	if (confirm(msg)) {
    	$.ajax({
		url: host,
		type: "POST",
		data: "id=" + dataId + "&status=" + stat + "&ForModel=" + forModel,
		success: function (data) {
			if(data)
			{
				if(newImgName == 'inactive.png'){				
					$("#"+dataId).attr("src",changesrc);
					$("#"+dataId).attr("title","Active");
					$('#successFlashMsg-5').show();
					setTimeout(function() {
						$("#successFlashMsg-5").hide('blind', {}, 200)
					}, 1000);
				}else{
					$("#"+dataId).attr("src",changesrc);
					$("#"+dataId).attr("title","InActive");
					$('#successFlashMsg-6').show();
					setTimeout(function() {
						$("#successFlashMsg-6").hide('blind', {}, 200)
					}, 1000);
				}
			}else{
				alert('There is some problem. Please try again.');
			}
		}
	 });
    }
    return false;}
//////////////////////////////////////////////////////////////////

$(document).ready(function(e) {
   
   $('#UserOldPassword').blur(function(e) {
        var UserOldPassword = $('#UserOldPassword').val();
		var UserId = $('#UserId').val();
		var UserUrl = $('#UserUrl').val();
				
		$.ajax({
		url: UserUrl,
		type: "POST",
		data: "id=" + UserId + "&password=" + UserOldPassword,
		success: function (data) {
			if(data!='1')
			{
				alert('Please re enter your password your old password do not match');
				$('#UserOldPassword').val('');
				//$('#UserOldPassword').focus();	
			}
		}
	 });
    });
//////////////////////////////////////////////////////////////////

$('#UserCpassword').blur(function(e) {
	var UserPassword = $('#UserPassword').val();
	var UserCpassword = $('#UserCpassword').val();
	
	if(UserPassword!= UserCpassword){
		alert('Confirm password doesn’t match. Please re enter the correct password');
				$('#UserCpassword').val('');
				$('#UserCpassword').focus();
	}
    });
//////////////////////////////////////////////////////////////////

//replace count character in trip idea page add and edit	
$("#PlaceShortDescription").keyup(function(e) {
    var $this = $(this);
    var wordcount = $this.val().length;		
    $('#countwords').html(wordcount);   });	

	//////////////////////////////////////////////////////////////////
//replace count character in trip idea page add and edit	
$("#TripideaShortDescription").keyup(function(e) {
    var $this = $(this);
    var wordcount = $this.val().length;		
    $('#countwords').html(wordcount);   });
//////////////////////////////////////////////////////////////////

var count = 1
$('#addMore').click(function(e) {	
	count++;
	var old = count;
	var data = "<div id='"+count+"_remove' class='form-group col-xs-7'><label>Tripidea Image <span>(Required Field)</span></label><input type='file' name='data[TripideaImage][image][]' id='' /></div><div id='"+count+"' class='imageRemove'><a class='btn btn-danger'>Remove</a></div><div class='clear-both'></div>";
    $('.mulitpleImages').append(data);
	
});
/////////////////////////////////////////////////////////////////

$('.imageRemove').live('click',function(e) {
	
    var id = this.id;
	$('#'+id+'_remove').remove();
	$('#'+id).remove();
});
/////////////////////////////////////////////////////////////////

$('.deleteImage').click(function(e) {
    var id 		= this.id;
	var dataId 	= $(this).attr("data-id");
	var host 	=  $(this).attr("data-rel");
	var title 	= $(this).attr("title");
	
	if(title=='Delete this main image'){
		alert('Please set a default image, before deleting this');
		return false;
	}
	
	
	var n = $( ".imageList ul li" ).length;
	if(n<2){
		if(!confirm('Are you sure you want to delete this image as only one image is left now.')){
		return false;	
		}
	}
	if(confirm('Are you sure you want to delete this image?')){
		
    	$.ajax({
		url: host,
		type: "POST",
		data: "id=" + dataId,
		success: function (data) {
			if(data=='1')
			{
				$('#deleteImage_'+id).remove();
			}else{
				alert('There is some problem in image delete. Please try again.');
			}
		}
	 });
    	
	}
	
});
/////////////////////////////////////////////////////////////////

$('#BannerUrl').blur(function() {
    var txt = $('#BannerUrl').val();
	 var re = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
	if (!re.test(txt)) {
	alert('Please enter valid url');
	}
	
});
//////////////////////////////////////////////////////////////////

var count = 1
$('#addMorePlace').click(function(e) {	
	count++;
	var old = count;
	var data = "<div id='"+count+"_remove' class='form-group col-xs-7'><label>Place Image <span>(Required Field)</span></label><input type='file' name='data[PlaceImage][image][]' id='' /></div><div id='"+count+"' class='imageRemovePlace'><a class='btn btn-danger'>Remove</a></div><div class='clear-both'></div>";
    $('.mulitpleImages').append(data);
	
});
/////////////////////////////////////////////////////////////////

$('.imageRemovePlace').live('click',function(e) {
	
    var id = this.id;
	$('#'+id+'_remove').remove();
	$('#'+id).remove();
});
/////////////////////////////////////////////////////////////////

$('.deleteImagePlace').click(function(e) {
    var id 		= this.id;
	var dataId 	= $(this).attr("data-id");
	var host 	=  $(this).attr("data-rel");
	
	if(confirm('Are you sure to delete this image ?')){
		
    	$.ajax({
		url: host,
		type: "POST",
		data: "id=" + dataId,
		success: function (data) {
			if(data=='1')
			{
				$('#deleteImage_'+id).remove();
			}else{
				alert('There is some problem in image delete. Please try again.');
			}
		}
	 });
    	
	}
	
});
/////////////////////////////////////////////////////////////////
$('#PlaceUrl').blur(function() {
    var txt = $('#PlaceUrl').val();
	 var re = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
	if (!re.test(txt)) {
	alert('Please enter valid url');
	}
	
});
/////////////////////////////////////////////////////////////////
$('#TripideaAdminEditForm').submit(function() {
		
		var htmlData = $('.imageList ul').html();
		var imgData  = $('#TripideaImageImage').val();
		
		if(htmlData.trim() =='' && imgData.trim()==''){
			alert('Please select at least one image to continue');
			return false;
		}
        
    });
	
 $('#BannerCountryIsoCode').change(function() {
	 
	 $('#loadState').removeClass('hide-loader');
	 $('#loadState').addClass('show-loader');
     
	    var IsoCode = $('#BannerCountryIsoCode').val();
		var StateUrl = $('#BannerCountryIsoCode').data('rel');
		
				
		$.ajax({
		url: StateUrl,
		type: "POST",
		data: "IsoCode=" + IsoCode,
		success: function (data) {
			if(data!='1')
			{		
				$('#loadState').removeClass('show-loader');
	 			$('#loadState').addClass('hide-loader');		
				$('#BannerStateCode').html(data);
				$('#BannerCityId').html('');
			}else{
				alert('Please select another country');
			}
		}
	 });
    });

$('#BannerStateCode').change(function() {
	 
	 $('#loadCity').removeClass('hide-loader');
	 $('#loadCity').addClass('show-loader');
     
	    var IsoCode 	= $('#BannerCountryIsoCode').val();
	    var StateCode 	= $('#BannerStateCode').val();
		var CityUrl		= $('#BannerStateCode').data('rel');
		
				
		$.ajax({
		url: CityUrl,
		type: "POST",
		data: {StateCode:StateCode,IsoCode:IsoCode},
		success: function (data) {
			if(data!='1')
			{		
				$('#loadCity').removeClass('show-loader');
	 			$('#loadCity').addClass('hide-loader');		
				$('#BannerCityId').html(data);
			}else{
				alert('Please select another state');
			}
		}
	 });
    });	
////////////////////////////////////////////default hide the three element
$('#code_widget').hide();
$('#url').hide();
$('#code_priority').hide();
///////////////////////////////show element when we check value other then none	
var PlaceIsHotel = $('#PlaceIsHotel').val();
if(PlaceIsHotel!='none'){
		$('#code_widget').show();
		$('#url').show();
		$('#code_priority').show();
	}
/////////////////////////////////////////////////

$('#PlaceIsHotel').change( function(event){
	var value = $('#PlaceIsHotel').val();
	if(value!='none'){
		$('#code_widget').show();
		$('#url').show();
		$('#code_priority').show();
	}else{
		$('#code_widget').hide();
		$('#url').hide();
		$('#code_priority').hide();
	}
  
});
/////////////////////shwo input when is proirty is checked

if($("#PlaceCodePriority").prop('checked') == true){
  		$('#PlaceUrl').attr( 'disabled','disabled' );
		$('#PlaceCodeWidget').removeAttr( 'disabled' );
	}else{
	
		
  		$('#PlaceUrl').removeAttr( 'disabled' );
		$('#PlaceCodeWidget').attr( 'disabled','disabled' );
	}
	

$('#PlaceCodePriority').on('ifClicked', function(event){
  	$('#PlaceCodePriority').on('ifChecked', function(event){
  		$('#PlaceUrl').attr( 'disabled','disabled' );
		$('#PlaceCodeWidget').removeAttr( 'disabled' );
	});
	$('#PlaceCodePriority').on('ifUnchecked', function(event){
  		$('#PlaceUrl').removeAttr( 'disabled' );
		$('#PlaceCodeWidget').attr( 'disabled','disabled' );
	});
});
///////////////////
$('#PlaceAdminEditForm').submit(function(){
		
		var PlaceIsHotel = $('#PlaceIsHotel').val();
		var code_widget  = $('#PlaceCodeWidget').val();
		var url 		 = $('#PlaceUrl').val();
		
	if(PlaceIsHotel=='hotel'){
		if(code_widget=='' && url==''){
			alert('Please fill at least one option either Code widget or url');
			return false;
		}
	}
});
////////////////////////////////////////////////////////
$('#PlaceAdminAddForm').submit(function(){
		
		var PlaceIsHotel = $('#PlaceIsHotel').val();
		var code_widget  = $('#PlaceCodeWidget').val();
		var url 		 = $('#PlaceUrl').val();
		
	if(PlaceIsHotel=='hotel'){
		if(code_widget=='' && url==''){
			alert('Please fill at least one option either Code widget or url');
			return false;
		}
	}
});
///////////////////
 $('#PlaceCountryIsoCode').change(function() {
	 
	 $('#loadState').removeClass('hide-loader');
	 $('#loadState').addClass('show-loader');
     
	    var IsoCode = $('#PlaceCountryIsoCode').val();
		var StateUrl = $('#PlaceCountryIsoCode').data('rel');
		
				
		$.ajax({
		url: StateUrl,
		type: "POST",
		data: "IsoCode=" + IsoCode,
		success: function (data) {
			if(data!='1')
			{		
				$('#loadState').removeClass('show-loader');
	 			$('#loadState').addClass('hide-loader');		
				$('#PlaceStateCode').html(data);
				$('#PlaceCityId').html('');
			}else{
				alert('Please select another country');
			}
		},
               timeout: 2000000000,
               async: false
	 });
    });
$('#PlaceStateCode').change(function() {
	 
	 $('#loadCity').removeClass('hide-loader');
	 $('#loadCity').addClass('show-loader');
     
	    var IsoCode 	= $('#PlaceCountryIsoCode').val();
	    var StateCode 	= $('#PlaceStateCode').val();
		var CityUrl		= $('#PlaceStateCode').data('rel');
		
				
		$.ajax({
		url: CityUrl,
		type: "POST",
		data: {StateCode:StateCode,IsoCode:IsoCode},
		success: function (data) {
			if(data!='1')
			{		
				$('#loadCity').removeClass('show-loader');
	 			$('#loadCity').addClass('hide-loader');		
				$('#PlaceCityId').html(data);
			}else{
				alert('Please select another state');
			}
		},
               timeout: 20000000000,
               async: false
	 });
    });	
});// End document.ready here
//////////////////////////////////////////////////////////////////



 
 $(document).ready(function(){
	
	
	
	
	/********* Insert numeric value only **********/
	$(".numericInt").on("keydown blur",function (event) {  
	   $(this).val($(this).val().replace(/[^\d].+/, ""));
		if (((event.which < 48 || event.which > 57) && (event.which != 8) && (event.which != 46) && (event.which != 37) && (event.which != 38) && (event.which != 39) && (event.which != 40) && (event.which != 9))) {
			event.preventDefault();
		}
	});
		
   /********* Insert decimal value only **********/
   $(".numericdecimal").on("keydown blur",function (event) {
		$(this).val($(this).val().replace(/[^0-9\.]/g,''));
		if (($(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which != 8) && (event.which != 46) && (event.which != 9)) {
			event.preventDefault();
		}
	});
	
 });
 
 
 $('input').attr('autocomplete','off');
 