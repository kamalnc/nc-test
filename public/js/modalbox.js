$.ajaxSetup({
	cache: false
});
var modalWindow = {  
	parent:"body",  
	windowId:'myModal', 
	moduleId:null,
   
	close:function()  
	{  
		$(".modal-window").remove();  
		$(".modal-overlay").remove();  
	},
	
	open:function()  
	{ 
		var modal = "";  
		modal += "<div class=\"modal-overlay\"></div>";  
		modal += "<div id=\"" + this.windowId + "\" class=\"modal-window\">"; 
                modal += $('#' + this.moduleId).attr('data-popuptext');
		modal += "</div>";   
		$(this.parent).append(modal); 
		$('.modal-window').append("<a class=\"close-window\"></a>");
		$(".close-window").click(function(){
                    modalWindow.close();
		});  
		$(".modal-overlay").click(function(){
                    modalWindow.close();
                });
	},
			
	center:function()
	{
		var modal_height = $('#myModal').outerHeight();  
		var modal_width = $('#myModal').outerWidth();  
		//calculate top and left offset needed for centering  
		var top = (($(window).height()) - modal_height)/2;  
		var left = (($(window).width()) - modal_width)/2;  
		$('#myModal').css('top', top);
		$('#myModal').css('left', left);
	}
	
};

var openMyModal = function()  
{  
	modalWindow.moduleId = $(this).attr('id');
	modalWindow.open(); 
	modalWindow.center();
}; 
//////////////////////////////////////////////Report Window//////////////////////////////////////////////////////
//
//
//var reportWindow = {  
//	parent:"body",  
//	windowId:'reportModal', 
//	moduleId:null,
//   
//	close:function()  
//	{  
//		$(".report-window").remove();  
//		$(".modal-overlay").remove();  ;
//	},
//	
//	open:function()  
//	{ 
//		var room = $('body').data('room');
//		var modal = "";  
//		modal += "<div class=\"modal-overlay\"></div>";  
//		modal += "<div id=\"" + this.windowId + "\" class=\"report-window\">";  
//		modal += "</div>";  
//		$(this.parent).append(modal);
//		var reportTemplatePath =  'ReportTemplate.php?room=' + room; 
//		$.ajax({
//			url: reportTemplatePath,
//			cache: false,
//			type: 'GET',
//			success: function(){
//				$('.report-window').load(reportTemplatePath, function(){	
//					$('.report-window').append("<a class=\"close-window\"></a>");
//					getJsonReport();
//					$(".close-window").click(function(){
//						reportWindow.close();
//					});
//					$(".modal-overlay").click(function(){
//						reportWindow.close();
//					});	
//				});
//			},
//			error: function(){
//				$('.report-window').load('modules/popupStandard.html', function(){
//					$('.report-window').append("<a class=\"close-window\"></a>");
//					$(".close-window").click(function(){
//						reportWindow.close();
//					});  
//					$(".modal-overlay").click(function(){
//						reportWindow.close();
//					});
//				});
//			} 
//		});	
//},
//			
//center:function()
//{
//	var modal_height = $('#reportModal').outerHeight();  
//	var modal_width = $('#reportModal').outerWidth();  
//	//calculate top and left offset needed for centering  
//	var top = (($(window).height()) - modal_height)/2;  
//	var left = (($(window).width()) - modal_width)/2;  
//	$('#reportModal').css('top', top);
//	$('#reportModal').css('left', left);
//}
//
//};
//
//	
//var reportModal = function()  
//{  
//	reportWindow.open(); 
//	reportWindow.center();
//}