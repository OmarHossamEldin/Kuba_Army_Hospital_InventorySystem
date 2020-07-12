$(document).ready(function(){
    $(".itemsearcher").focus();
    //start navigate in all inputs using enter
	$(".vertical").keypress(function(event) {
        if(event.keyCode == 13) { 
        textboxes = $(".vertical");
        
        currentBoxNumber = textboxes.index(this);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            event.preventDefault();
            return false 
            }
        } 
    });
    //start getting start getting item from db using name
	$(".itemsearcher").keyup(function(){
		var itemname=$(".itemsearcher").val();	
		$.ajax({
			url: "/item",
			method: "POST",
			data: {
                _token:$('meta[name="csrf-token"]').attr("content"),
                itemname:itemname
            },
			success: function (data) {
				$(".itemsearcher").autocomplete({
					source: data
				});

			},error(e){
				console.log(e);
			}
		});
    });
    // selecting item
    $('.selection').click(function(){
        var item=$(".itemsearcher").val();
        $.ajax({
			url: "/itemselection",
			method: "POST",
			data: {
                _token:$('meta[name="csrf-token"]').attr("content"),
                item:item
            },
			success: function (data) {
                if(data[0]=='error'){
                    return Swal({
                                type: data[0],
                                title: 'خطاء',
                                text: data[1],
                            });
                }
                $('.searchresult').html('');
                $('.searchresult').html(data[1]);
			},error(e){
				console.log(e);
			}
		});
    });
});