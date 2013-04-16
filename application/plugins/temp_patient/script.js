var module = {
        inStandard: 'bg_green_gradient',
        outStandard: 'bg_red_gradient',
	init: function() {
            this.changeColor();
	},
        
        changeColor: function(){
            var max_temp = $('#temp_pat_max').text();
            var min_temp = $('#temp_pat_min').text();
            var curr_temp = $('#temp_pat_current_value').text();
            
            if(curr_temp > max_temp || curr_temp < min_temp && !isNaN(curr_temp)){      
        	$('#temp_patient').addClass(this.outStandard);
                $('#temp_patient').removeClass(this.inStandard);
            }else{
                $('#temp_patient').removeClass(this.outStandard);
                $('#temp_patient').addClass(this.inStandard);
            }
        }
	
};
