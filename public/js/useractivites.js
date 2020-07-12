$(document).ready(function(){
	var start=$('.dateText1').val(),
        end =$('.dateText2').val();
		$.ajax({
			url: "/user/activites",
			method: "POST",
			data: {
                _token:$('meta[name="csrf-token"]').attr("content"),
                start:start,
                end:end
			},
			success: function (data) {
                $('.userActivitiesCont').html('');
                $('.userActivitiesCont').html(data);
			},error:function(e){
				console.log(e);	
			}
        });
    /*start usersnames from db */
    $(".username").keyup(function(){
		var username =$('.username').val();
		$.ajax({
			url: "/usernames",
			method: "POST",
            data: {
                username:username,
                _token:$('meta[name="csrf-token"]').attr("content")
            },
			success: function (data) {
				$(".username").autocomplete({
					source: data
				});

			},error(e){
				console.log(e);
			}
		});
    });
    /*end usersnames from db */
	/*start users activites hisotry */
	$('.show').click(function(){
        var start=$('.dateText1').val(),
            end  =$('.dateText2').val(),
            username =$('.username').val();
            $.ajax({
                url: "/user/activites",
                method: "POST",
                data: {
                    _token:$('meta[name="csrf-token"]').attr("content"),
                    start:start,
                    end:end,
                    username:username
                },
                success: function (data) {
                    $('.userActivitiesCont').html('');
                    $('.userActivitiesCont').html(data);
                },error:function(e){
                    console.log(e);	
                }
            }); 
	});
    /*end users activites hisotry */
    
});