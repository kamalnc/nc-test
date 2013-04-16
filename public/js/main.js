var resizeTimer = null;

$(document).ready(function() {
	var columnWidth = setColumnDimensions();
	setBaseFontSizes();
	setMinMaxFontSize();
	addModalPopups();
	$('#layout').isotope({
		masonry: {
			columnWidth: columnWidth
		},
		itemSelector : '.module',
		animationEngine : 'jquery'
	});
	
	toastr.success('Succesvol geladen.', 'Status');
	
	$(window).resize(function() {
		if(resizeTimer === null) {
			resizeTimer = setTimeout(function() {
				var columnWidth = setColumnDimensions();
				setBaseFontSizes();
				$('#layout').isotope({
					masonry: {
						columnWidth: columnWidth
					}
				});
				resizeTimer = null;

				for(var moduleScript in moduleScripts) {
					if($.isFunction(moduleScripts[moduleScript].resize)) {
						moduleScripts[moduleScript].resize();
					}
				}
				modalWindow.center();
			}, 1);
		}
	});
	for(var moduleScript in moduleScripts) {
		
		if($.isFunction(moduleScripts[moduleScript].init)) {
			moduleScripts[moduleScript].init();
		}
	}
        getNewData();
});

function getNewData(){
    var room =  $('body').data('room'); //TODO: validate room ID 
    var url = '/index/update/room/' + room;
    $.get(url, function(data) {
        //setTimeout(getNewData, refreshSpeed);
        console.log(data);
    });
}

function getJSONData() {
	var room = $('#layout').data('room');
	if(room > 0) {
		$.ajax({
			async: false,
			url: 'json.php?room=' + room,
			dataType: 'json',
			timeout: 5000,
			success: function(result, textStatus, XMLHttpRequest) {
				updateData(result);
				setTimeout(getJSONData, refreshSpeed);
			},

			error: function(XMLHttpRequest, textStatus, errorThrown) {
			},

			complete: function(XMLHttpRequest){
			
			}
		});
	}
}

function updateData(jsonData) {
	for(var module in jsonData) {
		var moduleData = jsonData[module];
		for(var updatable in moduleData) {
			var updatableID = '#' + module + '_' + updatable;
			$(updatableID).html(moduleData[updatable]);
		}
		checkStandards(module);
	}
}

function setBaseFontSizes() {
	var baseFontSize = Math.floor($('body').height() * 0.03);
	$('body').css('font-size', baseFontSize);
	
	$('.module').each(function() {
		baseFontSize = Math.floor($(this).height() * 0.115);
		$(this).css('font-size', baseFontSize);
	});
}

/*
 *This method sets the font sizes of the min and max values of the little
 *min_max_divs. It is always readable. 
 */
function setMinMaxFontSize(){
	$('.module').each(function() {
		if(($(this).hasClass('popup'))){
			var moduleName = $(this).attr('id');
			var standardMinValue = $('#' + moduleName + '_min_value').text();
			var standardMaxValue = $('#' + moduleName + '_max_value').text();
			if(standardMinValue.length > 3){
				$('#' + moduleName + '_min_value').css('font-size', 0.8 + 'em');
			}
			if(standardMinValue.length > 4){
				$('#' + moduleName + '_min_value').css('font-size', 0.7 + 'em');
			}
			
			if(standardMaxValue.length > 3){
				$('#' + moduleName + '_max_value').css('font-size', 0.8 + 'em');
			}
			if(standardMaxValue.length > 4){
				$('#' + moduleName + '_max_value').css('font-size', 0.7 + 'em');
			}
		}
	});
}

function setColumnDimensions() {
	var columnWidth = calculateColumnWidth();
	var columnHeight = calculateColumnHeight();
	var columnLength = columnWidth < columnHeight ? columnWidth : columnHeight;
	var layoutWidth = columnLength * $('#layout').data('width');
	
	layoutWidth += $('#layout').data('width') * 10;
	
	var layoutHeight = columnLength * $('#layout').data('height');
	layoutHeight += $('#layout').data('height') * 10;
	
	$('#layout').width(layoutWidth + 5);
	$('#layout').height(layoutHeight + 5);
	
	$('.module').each(function() {
		var moduleWidth = columnLength * $(this).data('width');
		moduleWidth += ($(this).data('width') - 1) * 10;
		$(this).width(moduleWidth);
		
		var moduleHeight = columnLength * $(this).data('height');
		moduleHeight += ($(this).data('height') - 1) * 10;
		$(this).height(moduleHeight);
	});	
	
	return columnLength + 10;
}

function calculateColumnWidth() {
	var absoluteLayoutWidth = $(window).width() - 10;
	var dividedWidth = Math.floor(absoluteLayoutWidth / $('#layout').data('width'));
	return dividedWidth - 10;
}

function calculateColumnHeight() {
	var absoluteLayoutHeight = $(window).height() - 10;
	var dividedHeight = Math.floor(absoluteLayoutHeight / $('#layout').data('height'));
	return dividedHeight - 10;
}

/*
 *Gives a module a click event if the module needs a
 *modal window.
 */
function addModalPopups() {
	$('.module').each(function() {
		if($(this).data('popuptext')){
			if(this.addEventListener)
			{
				this.addEventListener('click', openMyModal, false);
			}else{
				this.attachEvent('onclick', openMyModal);
			}
			$(this).append('<div id=\"' + $(this).attr('id') + '_infoImageId"\ class=\"infoImage"\></div>');
		}
		if($(this).hasClass('report')){
			if(this.addEventListener)
			{
				this.addEventListener('click', reportModal , false);
			}else{
				this.attachEvent('onclick', reportModal );
			}
		}
	}
	)
}

function getJsonReport(){
	var room = $('#layout').data('room');
		if(room > 0) {
			$.ajax({
				url: 'reportJson.php?room=' + room,
				dataType: 'json',
				success: function(result, textStatus, XMLHttpRequest) {
					appendReportData(result);
				},

				error: function(XMLHttpRequest, textStatus, errorThrown) {
				},

				complete: function(XMLHttpRequest){
			
				}
			});
		}
}

function appendReportData(reportJsonData){		
	for(var module in reportJsonData) {
		var reportModuleData = reportJsonData[module];
		for(var reportPart in reportModuleData) {
			var reportData = reportModuleData[reportPart];
			for(var data in reportData){
				var reportDataString = '<div class=\'field\'>';
				reportDataString += '<span class=\'label\'>' + data + ':</span>';
				reportDataString += '<span class=\'value\'>' + reportData[data] + '</span>';
				reportDataString += '</div>';	
				$('#' + reportPart).append(reportDataString);
			}
		}
	}
}

function addCssClass(divId, cssClass){
	$(divId).addClass(cssClass);
}

function removeCssClass(divId, cssClass){
	$(divId).removeClass(cssClass);
}

/*
 * This method checks if the value he gets from the system is between
 * or outside the standards.
 * @param moduleName the name of the module where we get data from
 */
function checkStandards(moduleName){
	var currentValue = $('#' + moduleName + '_current_value').text();
	var standardMinValue = $('#' + moduleName + '_min_value').text();
	var standardMaxValue = $('#' + moduleName + '_max_value').text();
	var isBetweenStandard = false;
	
	if(standardMaxValue == ''){
		standardMaxValue = null;
	}
	if(standardMinValue == ''){
		standardMinValue = null;
	}
	if(isNaN(standardMaxValue)){
		standardMaxValue = null;
	}
	if (isNaN(standardMinValue)){
		standardMinValue = null;
	}
	if(isNaN(currentValue)){
		currentValue = null;
	}
	//Check all possibilities for the standards. 
	if(standardMaxValue !== null){
		if(standardMinValue !== null){
			if(currentValue >= standardMinValue && currentValue <= standardMaxValue){
				isBetweenStandard = true;
			}else if (currentValue < standardMinValue || currentValue > standardMaxValue){
				isBetweenStandard = false;
			}
		}else{
			if(currentValue <= standardMaxValue){
				isBetweenStandard = true;
			}
		}
	}else{
		if(standardMinValue !== null){
			if(currentValue > standardMaxValue){
				isBetweenStandard = false; 
			}else if(currentValue > standardMinValue){
				isBetweenStandard = true;
			}
		}
	}
	if(standardMaxValue == null && standardMinValue == null){
		isBetweenStandard = true;
	}
	if(currentValue == null){
		isBetweenStandard = true;
	}
	
	checkColorChange(moduleName, isBetweenStandard);
}

/*
 * In the database a module gets a class wich defines the color schema of a
 * module if the value is between the standard or not. With the moduleName
 * we check if a module has a curtain class to define the color schema. 
 * @param moduleName the name of the module we need to check the color scheme from
 * @param isBetweenStandard a boolean wich defines if the current value is between or outside the standards
 */
function checkColorChange(moduleName, isBetweenStandard){
	var betweenStandardColor;
	var	outsideStandardColor;
	var	betweenStandardBackground;
	var	outsideStandardBackground;
	if($('#' + moduleName).hasClass('green_red')){
		betweenStandardBackground = 'bg_green_gradient';
		outsideStandardBackground = 'bg_red_gradient';
	} else if ($('#' + moduleName).hasClass('black_red')){
		betweenStandardColor = 'div_elements_color_green';
		outsideStandardColor = 'div_elements_color_red';
	}else{
		betweenStandardBackground = 'bg_green_gradient';
		outsideStandardBackground = 'bg_red_gradient'
		betweenStandardColor = 'div_elements_color_green';
		outsideStandardColor = 'div_elements_color_red';
	}
	if(betweenStandardBackground == null && outsideStandardBackground == null ){
		changeCurrValueColor(moduleName, betweenStandardColor, outsideStandardColor, isBetweenStandard);
	} else{
		changeBackgroundColor(moduleName, betweenStandardBackground, outsideStandardBackground, isBetweenStandard);
	}

}

/*
 * This method changes one element, this is for example for the doorcounter where we only need to change
 * the color of the current doorcount.
 * @param moduleName the name of the module we need to check the color scheme from
 * @param betweenStandardColor the CSS class of the color that need to be set/removed if the value is between the standards
 * @param outsideStandardColor the CSS class of the color that need to be set/removed if the value is between the standards
 * @param isBetweenStandard a boolean wich defines if the current value is between or outside the standards
 */
function changeCurrValueColor(moduleName, betweenStandardColor, outsideStandardColor, isBetweenStandard){
	var max_value = $('#' + moduleName + '_current_value')
	if(isBetweenStandard == false){
		addCssClass(max_value, outsideStandardColor);
		removeCssClass(max_value, betweenStandardColor);
	} else if(isBetweenStandard == true){
		addCssClass(max_value, betweenStandardColor);
		removeCssClass(max_value, outsideStandardColor);
	}
}

/*
 * Because all inside elements change their color with opacity, we only need to change the background of a
 * module.  
 * @param moduleName the name of the module we need to check the color scheme from
 * @param betweenStandardBackground the CSS class of the background that need to be set/removed if the value is between the standards
 * @param outsideStandardBackground the CSS class of the background that need to be set/removed if the value is between the standards
 * @param isBetweenStandard a boolean wich defines if the current value is between or outside the standards
 */
function changeBackgroundColor(moduleName, betweenStandardBackground, outsideStandardBackground, isBetweenStandard){
	var module = $('#' + moduleName);
	if(isBetweenStandard == false){
		addCssClass(module, outsideStandardBackground);
		removeCssClass(module, betweenStandardBackground);
	} else if (isBetweenStandard == true){
		addCssClass(module, betweenStandardBackground);
		removeCssClass(module, outsideStandardBackground);
	}
}