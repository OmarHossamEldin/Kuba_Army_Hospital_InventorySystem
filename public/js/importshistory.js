$(document).ready(function(){
	
	/*start expanses hisotry */
	$('.show').click(function(){
        let start=$('.dateText1').val(),
            end =$('.dateText2').val();
		$.ajax({
			url: `/importshistory/${start}/${end}`,
			method: "GET",
			success: function (data) {
                $('.importstablerows').html('');
                $('.importstablerows').html(data);
			},error:function(e){
				console.log(e);	
			}
		});
	});
	/*end expanses hisotry */
});