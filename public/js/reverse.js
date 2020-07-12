$(document).ready(function(){

	//start getting start getting item from db
	var	itemmount=$('.itemmount'),
		itemprice=$('.itemprice'),
		itemtprice=$('.itemtprice');
	$(".itemname").keyup(function(){
		var itemname=$(".itemname").val();
		$.ajax({
			url: "/item",
			method: "POST",
			data: {itemname:itemname},
			success: function (data) {
				$(".itemname").autocomplete({
					source: data
				  });;

			},error(e){
				console.log(e);
			}
		});
	});
	$(".itemname").change(function(){
		var itemname=$(".itemname").val();
		$.ajax({
			url: "/itemid",
			method: "POST",
			data: {itemname:itemname},
			success: function (data) {
                $(".itembarcode").val(data.id).blur(function(){
                    var itemid =$(".itembarcode").val();
                        $.ajax({
                                url: "/itemsales",
                                method: "POST",
                                data: {itemid:itemid},
                                success: function (data) {
                                    console.log(data);
                                    $('.itemmount').attr("max",data.quantity.quantity);
                                    $('.itemmount').attr("min","0");
                                    $('.itemprice').val(data.buyPrice);
                                }
                        });
                });
			},error(e){
				console.log(e);
			}
		});
    });
	itemmount.change(function(){
		itemtprice.val(itemmount.val()*itemprice.val());
	});
	//end start getting item from db


	// start making bill  table ======================>
	var items_container=new Array();// container
	function making_bills(){
		$(".itembarcode").val('');
		$('.itemname').val('');
		$('.itemmount').val('');
		$('.itemprice').val('');
		$('.itemtprice').val('');
		$('.bills_rows').html('');
		for(var i=0;i<items_container.length;i++){
				$('.bills_rows').append("<tr id='"+items_container[i][0]+"' >"+
                                					"<td>"+items_container[i][0]+"</td>"+
					                                "<td>"+items_container[i][1]+"</td>"+
					                                "<td>"+items_container[i][2]+"</td>"+
					                                "<td>"+items_container[i][3]+"</td>"+
													"<td >"+items_container[i][4]+"</td>"+
					                                "<td >"+
                                    					"<i class='far fa-2x fa-trash-alt'></i>"+
                                					"</td>"+
                            				"</tr>");
		}
		/*start calculating total bills */
		var total_money=0;
		for(var o=0;o<items_container.length;o++){
			total_money=total_money- -items_container[o][4];
		}
		$('.total_money').html(total_money);
		/*end calculating total bills */
	}
	// end making bill  table ======================>

	/*start adding products &mounts and total price of  item of the bill*/
	$('.addtobill').click(function(){
		var itemid=$(".itembarcode").val().trim(),
			itemname=$('.itemname').val().trim(),
			itemmount=$('.itemmount').val().trim(),
			itemprice=$('.itemprice').val().trim(),
            itemtprice=$('.itemtprice').val().trim();
            max=$('.itemmount').attr('max');
            if(Number(itemmount)>Number(max)){
                return Swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'لا يمكنك تخطي حد المخزن!!',
                        });
            }
		if((itemid=='')||(itemname=='')||(itemmount=='')||(itemprice=='')||(itemtprice=='')){
			Swal({
				type: 'error',
				title: 'خطاء...',
				text: 'من فضلك برجاء ملء كل الحقول!',
			});
		}
		else if((itemid==0)||(itemname==0)||(itemmount==0)||(itemprice==0)||(itemtprice==0)){
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
			var row=new Array(itemid,itemname,itemmount,itemprice,itemtprice);
				items_container.push(row);
				making_bills();
		}
	});
	/*end  adding products &mounts and total price of  item of the bill*/

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
		var id			=$('#id').val(),
        	supplier	=$('#supplier').val(),
			totalPrice  =$('.total_money').html(),
			supbills 	=items_container;
		$.ajax({
			url: "/reverse",
			method: "POST",
			data: {
				id:id,
				supplier:supplier,
				totalPrice:totalPrice,
				supbills:supbills
			},
			success: function (data) {
				if(data[0]=='error'){
					Swal({
						type: data[0],
						title: 'خطاء...',
						text: data[1],
					});
				}
				else{
					Swal({
						type: data[0],
						title: 'تم',
						text: data[1],
					});
					location.reload();
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
