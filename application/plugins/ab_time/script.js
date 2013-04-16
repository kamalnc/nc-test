var module = {
        inStandard: 'bg_green_gradient',
        outStandard: 'bg_red_gradient',
	init: function() {
            this.changeColor();
	},
        
        changeColor: function(){
            var max = $('#ab_time_max').text();
            var min = $('#ab_time_min').text();
            var curr = $('#ab_time_current_value').text();
            
            if(curr > max|| curr < min && !isNaN(curr)){      
        	$('#ab_time').addClass(this.outStandard);
                $('#ab_time').removeClass(this.inStandard);
            }else{
                $('#ab_time').removeClass(this.outStandard);
                $('#ab_time').addClass(this.inStandard);
            }
        }
	
};
