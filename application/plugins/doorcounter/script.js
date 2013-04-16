var module = {
        inStandard: 'div_elements_color_green',
        outStandard: 'div_elements_color_red',
	init: function() {
            this.changeColor();
	},
        
        changeColor: function(){
            var max = $('#doorcount_max').text();
            var curr = $('#doorcount_current').text();
            if(curr > max && !isNaN(curr) && !isNaN(max)){  
        	$('#doorcount_current').addClass(this.outStandard);
                $('#doorcount_current').removeClass(this.inStandard);
            }else{
                $('#doorcount_current').removeClass(this.outStandard);
                $('#doorcount_current').addClass(this.inStandard);
            }
        }
	
};
