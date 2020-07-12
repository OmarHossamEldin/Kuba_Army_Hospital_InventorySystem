$(document).ready(function(){
	//start getting item from db using barcode
	//start getting item from db using barcode
	var	itemname=$(".itemname");
	$(".itembarcode").on('change',function(){
		var itemid =$(".itembarcode").val();
		$.ajax({
			url: "/iteminfo",
			method: "POST",
			data: {
				_token:$('meta[name="csrf-token"]').attr("content"),
				itemid:itemid
			},
			success: function (data) {
				$('.itemmount').attr('limit','');
				$('.itemmount').attr('limit',data[1].quantity);
				$('.quantity').html(' ');
				$('.quantity').html(`الكمية المتاحة: ${data[1].quantity}`);
				itemname.val(data[0].name);
			}
		});
	});
	//end  start getting item from db using barcode
	//start getting start getting item from db using name
	$(".itemname").select2();
	$(".itemname").change(function(){
		$(".itembarcode").val($(this).val()).trigger("change");
	});
	//end start getting item from db using name
	// start making bill  table ======================>
	var items_container=new Array();// container
	function making_bills(){
		$(".itembarcode").val('');
		$('.itemname').val('');
		$('.itemmount').val('');
		$('.bills_rows').html('');
		for(var i=0;i<items_container.length;i++){
				$('.bills_rows').append("<tr id='"+items_container[i][0]+"' >"+
                                					"<td>"+items_container[i][0]+"</td>"+
					                                "<td>"+items_container[i][1]+"</td>"+
					                                "<td>"+items_container[i][2]+"</td>"+
					                                "<td >"+
                                    					"<i class='far fa-2x fa-trash-alt'></i>"+
                                					"</td>"+
                            				"</tr>");
		}
	}
	// end making bill  table ======================>

	/*start adding products &mounts  and all serials*/
	$('.addtobill').click(function(){
		var itemid=$(".itembarcode").val().trim(),
			itemname=$('.itemname').val().trim(),
			itemmount=$('.itemmount').val().trim();
		if((itemid=='')||(itemname=='')||(itemmount=='')){
			Swal({
				type: 'error',
				title: 'خطاء...',
				text: 'من فضلك برجاء ملء كل الحقول!',
			});
		}
		else if((itemid==0)||(itemname==0)||(itemmount==0)){
			Swal({
				type: 'error',
				title: 'خطاء...',
				text: 'براجاء إدخال قيم صالحه!',
			});
		}
		else{
			for(var i=0;i<items_container.length;i++){
				if(items_container[i][0]==itemid){
					return Swal({
						type: 'error',
						title: 'خطاء...',
						text: 'لا يمكن إدخال الصنف مرتين!!',
					});
				}
			}
			var row=new Array(itemid,itemname,itemmount);
				items_container.push(row);
				making_bills();
		}
	});
	/*end adding products &mounts  and all serials*/

	/*start deleting products &mounts and total price of  item of the bill*/
	$('table').on('click','i',function(){
		var id=$(this).parent().siblings().eq(0).html();
		var rest_options=new Array();

		for(var x=0;x<items_container.length;x++){
			if(items_container[x][0]==id){
				rest_options.push(items_container[x][1]);
				items_container.splice([x][0],1);
			}
		}
		making_bills();
	});
	/*end  deleting products &mounts and total price of  item of the bill*/
	/*start adding the bil and it's details */
	$('.printBill').click(function(){
		let id			=$('#id').val(),
			oraginNumber=$('.armynumber').val(),
			notes		=$("#notes").val(),
			items 		=items_container;
		$.ajax({
			url: "/imports",
			method: "POST",
			data: {
				_token:$('meta[name="csrf-token"]').attr("content"),
				id:id,
				oraginNumber:oraginNumber,
				notes:notes,
				items:items
			},
			success: function (data) {
				if(data[0]=='error'){
					Swal({
						type: data[0],
						title: 'خطاء...',
						text: data[1],
                    });
                    setTimeout(location.reload(),1000);
				}
				else{
					Swal({
						type: data[0],
						title: 'تم',
						text: data[1],
					});
					setTimeout(location.reload(),1000);
				}
			}, error:function (e) {
                    console.log(e);
            }
		});
	})
	/*end adding the bil and it's details */
	/*start reverse */
	$('#reverse').click(function(){
		var id=$('#reverse').attr('data');
		$.ajax({
			url: "/reversepurchase",
			method: "POST",
			data: {
				id:id
			},
			success: function (data) {
				Swal({
					type: data[0],
					title: 'تم',
					text: data[1],
				});
			},error:function(e){
				console.log(e);
			}
		});
	});
	/*end reverse */
});
