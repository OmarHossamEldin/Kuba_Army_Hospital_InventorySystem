$(document).ready(function(){
	
	/*start expanses hisotry */
	$('.show').click(function(){
        let start=$('.dateText1').val(),
            end =$('.dateText2').val();
		$.ajax({
			url: `/outputshistory/${start}/${end}`,
			method: "GET",
			success: function (data) {
                $('.outputstablerows').html('');
                $('.outputstablerows').html(data);
			},error:function(e){
				console.log(e);	
			}
		});
	});
	/*end expanses hisotry */
});