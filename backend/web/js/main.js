$(function(){
	$("#modalButton").click(function(){
		$("#modal").modal('show').find("#modalContent").load($(this).attr('value'));
	});
	
	
	//日历js
	$(document).on("click",'.fc-day',function(){
		var date=$(this).attr('data-date');
		$.get('index.php?r=event/create',{'date':date},function(data){
			$("#modal").modal('show').find("#modalContent").html(data);
		})
		
	});
});