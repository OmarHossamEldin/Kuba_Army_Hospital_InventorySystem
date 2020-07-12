$(document).ready(function(){
	/*start getting report  */
	$('.show').click(function(){
        var start=$('.dateText1').val(),
            end =$('.dateText2').val();
		$.ajax({
			url: "/report",
			method: "POST",
			data: {
                start:start,
                end:end
			},
			success: function (data) {
                $('.totalpurchase').html(' ');
                $('.totalpurchase').html(data[0]);
                $('.totalpaiedsalaries').html(' ');
                $('.totalpaiedsalaries').html(data[1]);
                $('.totalexpanses').html(' ');
                $('.totalexpanses').html(data[2]);
                $('.totalloan').html(' ');
                $('.totalloan').html(data[3]);
                $('.totalsells').html(' ');
                $('.totalsells').html(data[4]);
                $('.totalincome').html(' ');
                $('.totalincome').html(data[5]);
                $('.totalreceivable').html(' ');
                $('.totalreceivable').html(data[6]);
                $('.balance').html(' ');
                $('.balance').html(data[7]);
                $('.income').html(' ');
                $('.income').html(data[8]);
                $('.capital').html(' ');
                $('.capital').html(data[9]);
			},error:function(e){
				console.log(e);	
			}
		});
	});
    /*end getting report */
    // start printing report ===================================>
    $('.printreport').click(function(e){
        e.preventDefault();        
        $(".reportCont").printArea();    
    });
    //end printing report ===========>
});