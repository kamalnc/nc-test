var module = {
        inStandard: 'bg_green_gradient',
        outStandard: 'bg_red_gradient',
	init: function() {
            this.changeColor();
	},
        
        changeColor: function(){
            var max = $('#temp_diff_max').text();
            var min = $('#temp_diff_min').text();
            var curr = $('#temp_diff_current_value').text();
            
            if(curr > max|| curr < min && !isNaN(curr)){      
        	$('#temp_diff_OR_plenum').addClass(this.outStandard);
                $('#temp_diff_OR_plenum').removeClass(this.inStandard);
            }else{
                $('#temp_diff_OR_plenum').removeClass(this.outStandard);
                $('#temp_diff_OR_plenum').addClass(this.inStandard);
            }
        }
	
};
