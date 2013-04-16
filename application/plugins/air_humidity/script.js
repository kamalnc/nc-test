var module = {
        inStandard: 'bg_green_gradient',
        outStandard: 'bg_red_gradient',
	init: function() {
            this.changeColor();
	},
        
        changeColor: function(){
            var max = $('#air_humidity_max').text();
            var min = $('#air_humidity_min').text();
            var curr = $('#air_humidity_current_value').text();
            
            if(curr > max|| curr < min && !isNaN(curr)){      
        	$('#air_humidity').addClass(this.outStandard);
                $('#air_humidity').removeClass(this.inStandard);
            }else{
                $('#air_humidity').removeClass(this.outStandard);
                $('#air_humidity').addClass(this.inStandard);
            }
        }
	
};
