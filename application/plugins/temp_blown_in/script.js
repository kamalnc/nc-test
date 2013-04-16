var module = {
        inStandard: 'bg_green_gradient',
        outStandard: 'bg_red_gradient',
	init: function() {
            this.changeColor();
	},
        
        changeColor: function(){
            var max = $('#temp_blown_in_max').text();
            var min = $('#temp_blown_in_min').text();
            var curr = $('#temp_blown_in_current_value').text();
            
            if(curr > max|| curr < min && !isNaN(curr)){      
        	$('#temp_blown_in').addClass(this.outStandard);
                $('#temp_blown_in').removeClass(this.inStandard);
            }else{
                $('#temp_blown_in').removeClass(this.outStandard);
                $('#temp_blown_in').addClass(this.inStandard);
            }
        }
	
};
