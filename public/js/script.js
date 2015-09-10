$(document).ready(function() {
	        $('.selectpicker').multiselect();
	        
	        $('fieldset:not(:first)').children("div").hide();
	        
    		$('legend').click(function(){
    			$(this).parent().find('.content').slideToggle("slow");
    		});
	        
        	$('#mon-fri-button').on('click', function() {
        		$('#working_days').multiselect('deselect', ['0','1', '2','3' ,'4','5','6']);
            	$('#working_days').multiselect('select', ['0','1','2','3','4']);
          });
            $('#mon-sat-button').on('click', function() {
            	$('#working_days').multiselect('deselect', ['0','1', '2','3' ,'4','5','6']);
            	$('#working_days').multiselect('select', ['0','1', '2','3' ,'4','5']);
            });
            $('#mon-sun-button').on('click', function() {
            	$('#working_days').multiselect('deselect', ['0','1', '2','3' ,'4','5','6']);
            	$('#working_days').multiselect('select', ['0','1', '2','3' ,'4','5','6']);
            });
			$('.time').datetimepicker({
			  datepicker:false,
			  format:'H:i',
			  step: 30,
			  validateOnBlur: false
			});
			$('.date-short').datetimepicker({
				timepicker: false,
				format: 'd M Y',
				dayOfWeekStart: 1,
				validateOnBlur: false
			});
			$('#btn-new-lang').click(function(){
				$('#new-lang').clone().attr('id', '').removeClass('hide').addClass('new-lang').insertBefore($('#new-lang'));
				$('.new-lang .close').click(function(){
					$(this).parent().remove();
				});
		
				$('.new-lang .languages').multiselect({
						maxHeight: 250,
						selectedClass: null, 
						enableCaseInsensitiveFiltering: true
				});
			});
		
			$('.new-lang .close, .langs .close').click(function(){
				$(this).parent().remove();
			});
			$('.btn-full-reset').click(function(){
				$(this).closest('form').find(':input').not(':button, :submit, :reset, :hidden, .ignore-reset, .check_active').val('').removeAttr('checked').removeAttr('selected');
				
				$('option', $('[multiple]')).each(function(element) {
					$('[multiple]').multiselect('deselect', $(this).val());
				});
				
				$('.multiselect-holder option').each(function(element) {
					$('.multiselect-holder').multiselect('deselect', $(this).val());
				});
			    
				return false;
			});
			
			
			$('.clear').click(function(){
				$(this).prev().val(null);
			});
			
			$('.search_case').click(function(){
				path = window.location.pathname.split('/').slice(0,3).join('/');
				var reviews = $('input.cases:checked[type="checkbox"]').toArray().map(function(key,value){
					return key.value;
				});
				var request = {};
				$('input.cases[type="text"]').toArray().map(function(value,key){
					return request[$(value).attr('name')] = $(value).val();
				});
				request.reviews = reviews;
				request.employee_id = employee_id;
				request._token = Globals._token;
				$.post(path+'/again',request).done(function(data){
					$(".result").html(data);
				});
				
			});
			
			 $(".clickable-row").click(function() {
			     window.document.location = window.document.location.href.replace('search','')+'profile/'+$(this).attr('id');
			 });
			 
			 var ctx = document.getElementById("myChart").getContext("2d");
			var data = {
			    labels: chart_labels,
			    datasets: [
			        {
			            label: "My First dataset",
			            fillColor: "rgba(220,220,220,0.2)",
			            strokeColor: "rgba(220,220,220,1)",
			            pointColor: "rgba(220,220,220,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(220,220,220,1)",
			            data: chart_data
			        }
			    ]
			};
			var myLineChart = new Chart(ctx).Line(data, '');
			
			
			
        });