$( document ).ready(function() {

var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageData();

/* manage data list */
function manageData() {
    $.ajax({
        dataType: 'json',
        url: url+'api/getData.php',
        data: {page:page}
    }).done(function(data){
    	total_page = Math.ceil(data.total/10);
    	current_page = page;

    	$('#pagination').twbsPagination({
	        totalPages: total_page,
	        visiblePages: current_page,
	        onPageClick: function (event, pageL) {
	        	page = pageL;
                if(is_ajax_fire != 0){
	        	  getPageData();
                }
	        }
	    });

    	manageRow(data.data);
        is_ajax_fire = 1;

    });

}

/* Get Page Data*/
function getPageData() {
	$.ajax({
    	dataType: 'json',
    	url: url+'api/getData.php',
    	data: {page:page}
	}).done(function(data){
		manageRow(data.data);
	});
}

/* Add new Item table row */
function manageRow(data) {
	var	rows = '';
	$.each( data, function( key, value ) {
	  	rows = rows + '<tr>';
        rows = rows + '<td>'+value.orderid+'</td>';
	  	rows = rows + '<td>'+value.name+'</td>';
        rows = rows + '<td>'+value.mobile+'</td>';
	  	rows = rows + '<td>'+value.email+'</td>';
        rows = rows + '<td>'+value.date+'</td>';
        rows = rows + '<td>'+value.pnr+'</td>';
        rows = rows + '<td>'+value.orderfrom+'</td>';
        rows = rows + '<td>'+value.orderto+'</td>';
        if (value.status=="1"){
            rows = rows + '<td>'+'Đã gọi - Đồng ý'+'</td>';
        }
        if (value.status=="2"){
            rows = rows + '<td>'+'Đã gọi - Từ chối'+'</td>';
        }
        if (value.status=="3"){
            rows = rows + '<td>'+'Chưa gọi'+'</td>'; 
        }
        if (value.status=="4"){
            rows = rows + '<td>'+'Yêu cầu gọi lại'+'</td>';
        }
	  	rows = rows + '<td data-id="'+value.orderid+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';
	});

	$("tbody").html(rows);
}

/* Create new Item */
$(".crud-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var orderid = $("#create-item").find("input[name='orderid']").val();
    var name = $("#create-item").find("input[name='name']").val();
    var mobile = $("#create-item").find("input[name='mobile']").val();
    var email = $("#create-item").find("input[name='email']").val();
    var date = $("#create-item").find("input[name='date']").val();
    var pnr = $("#create-item").find("input[name='pnr']").val();
    var orderfrom = $("#create-item").find("input[name='orderfrom']").val();
    var orderto = $("#create-item").find("input[name='orderto']").val();
    var status = $("#create-item").find("select[name='status']").val();

    if(orderid != '' && name != '' && mobile != '' && email != '' && date != '' && pnr != '' && orderfrom != '' && orderto != ''  && status != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{orderid: orderid, name: name, mobile: mobile, email: email, date: date, pnr: pnr, orderfrom: orderfrom, orderto: orderto, status: status}
        }).done(function(data){
            $("#create-item").find("input[name='orderid']").val();
            $("#create-item").find("input[name='name']").val();
            $("#create-item").find("input[name='mobile']").val();
            $("#create-item").find("input[name='email']").val();
            $("#create-item").find("input[name='date']").val();
            $("#create-item").find("input[name='pnr']").val();
            $("#create-item").find("input[name='orderfrom']").val();
            $("#create-item").find("input[name='orderto']").val();
            $("#create-item").find("select[name='status']").val();

            getPageData();
            $(".modal").modal('hide');
            toastr.success('Thêm đơn hàng thành công !!!.', 'Thông báo', {timeOut: 5000});
        });
    }else{
        alert('Bạn nhập thiếu trường !!!.')
    }
});

/* Remove Item */
$("body").on("click",".remove-item",function(){
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url + 'api/delete.php',
        data:{id:id}
    }).done(function(data){
        c_obj.remove();
        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        getPageData();
    });

});
    

/* Edit Item */
$("body").on("click",".edit-item",function(){

    var orderid = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var name = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var mobile = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var email = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var date = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var pnr = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
    var orderfrom = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var orderto = $(this).parent("td").prev("td").prev("td").text();
    var status = $(this).parent("td").prev("td").text();

    if (status=="Đã gọi - Đồng ý"){
            status=1;
        }
    if (status=="Đã gọi - Từ chối"){
            status=2;
        }
    if (status=="Chưa gọi"){
            status=3;
        }
    if (status=="Yêu cầu gọi lại"){
            status=4;
        }

    $("#edit-item").find("input[name='orderid']").val(orderid);
    $("#edit-item").find("input[name='name']").val(name);
    $("#edit-item").find("input[name='mobile']").val(mobile);
    $("#edit-item").find("input[name='email']").val(email);
    $("#edit-item").find("input[name='date']").val(date);
    $("#edit-item").find("input[name='pnr']").val(pnr);
    $("#edit-item").find("input[name='orderfrom']").val(orderfrom);
    $("#edit-item").find("input[name='orderto']").val(orderto);
    $("#edit-item").find("select[name='status']").val(status);

});


/* Updated new Item */
$(".crud-submit-edit").click(function(e){

    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var id = $("#edit-item").find("input[name='orderid']").val();
    var name = $("#edit-item").find("input[name='name']").val();
    var mobile = $("#edit-item").find("input[name='mobile']").val();
    var email = $("#edit-item").find("input[name='email']").val();
    var date = $("#edit-item").find("input[name='date']").val();
    var pnr = $("#edit-item").find("input[name='pnr']").val();
    var orderfrom = $("#edit-item").find("input[name='orderfrom']").val();
    var orderto = $("#edit-item").find("input[name='orderto']").val();
    var status = $("#edit-item").find("select[name='status']").val();

    if(id != '' && name != '' && mobile != '' && email != '' && date != '' && pnr != '' && orderfrom != '' && orderto != ''  && status != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{id: id, name: name, mobile: mobile, email: email, date: date, pnr: pnr, orderfrom: orderfrom, orderto: orderto, status: status}
        }).done(function(data){
            getPageData();
            $(".modal").modal('hide');
            toastr.success('Sửa đơn hàng thành công !!!.', 'Thông báo', {timeOut: 5000});
        });
    }else{
        alert('Bạn nhập thiếu trường !!!.')
    }

});
});