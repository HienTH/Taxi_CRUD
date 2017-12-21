<!DOCTYPE html>
<html>
<head>
	<title>QLDH-ĐÔNG DƯƠNG DC</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

	<script type="text/javascript">
    	var url = "http://127.0.0.1:80/";
    </script>
    <style type="text/css">
    	.modal-dialog, .modal-content{
		z-index:1051;
		}
    </style>

    <script src="/js/item-ajax.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
		    <div class="col-lg-12 margin-tb">					
		        <div class="pull-left">
		            <h2>ĐÔNG DƯƠNG DC</h2>
		        </div>
		        <div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
					  Thêm
				</button>
		        </div>
		    </div>
		</div>

		<div class="panel panel-primary">
			  <div class="panel-heading">Quản Lý Đơn Hàng</div>
			  <div class="panel-body">
				<table class="table table-bordered">
					<thead>
					    <tr>
						<th>OrderID</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Email</th>
						<th>Date</th>
						<th>PNR</th>
						<th>OrderFrom</th>
						<th>OrderTo</th>
						<th>Status</th>
						<th width="200px">Action</th>
					    </tr>
					</thead>
					<tbody>
					</tbody>
				</table>

		<ul id="pagination" class="pagination-sm"></ul>
			  </div>
	  </div>

	    <!-- Create Item Modal -->
		<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Thêm đơn hàng</h4>
		      </div>
		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/create.php" method="POST">

		      			 <div class="form-group">
		                          <label for="orderid">Mã đơn hàng</label>
		                          <input type="text" id="orderid" name="orderid" placeholder="Nhập mã đơn hàng" class="form-control"/>
		                      </div>

		                      <div class="form-group">
		                          <label for="name">Tên hành khách</label>
		                          <input type="text" id="name" name="name" placeholder="Nhập tên hành khách" class="form-control"/>
		                      </div>

		                      <div class="form-group">
		                          <label for="mobile">Số điện thoại</label>
		                          <input type="text" id="mobile" name="mobile" placeholder="Nhập số điện thoại" class="form-control"/>
		                      </div>
		                      <div class="form-group">
		                          <label for="email">Email</label>
		                          <input type="text" id="email" name="email" placeholder="Nhập email" class="form-control" />
		                      </div>

		      			<div class="form-group">
						<label for="date">Ngày</label>
						<input type="date" id="date" name="date" placeholder="Nhập ngày" class="form-control" />
						</div>

						<div class="form-group">
						<label for="pnr">Mã chuyến bay</label>
						<input type="text" id="pnr" name="pnr" placeholder="Nhập mã chuyến bay" class="form-control" />
						</div>
						<div class="form-group">
						<label for="orderfrom">Địa điểm, giờ đi</label>
						<input type="text" id="orderfrom" name="orderfrom" placeholder="Nhập địa điểm, giờ đi" class=form-control" />
						</div>
						
						<div class="form-group">
						<label for="orderto">Địa điểm, giờ đến</label>
						<input type="text" id="orderto" name="orderto" placeholder="Nhập địa đểm, giờ đến" class="form-control" />
						</div>
						
						<div class="form-group">
						<label for="Trạng thái">Trạng thái</label>
						<select name="status" id="status">
  							<option value="1">Đã gọi - Đồng ý</option>
  							<option value="2">Đã gọi - Từ chối</option>
  							<option value="3">Chưa gọi</option>
  							<option value="4">Yêu cầu gọi lại</option>
						</select>
						</div>

						<div class="form-group">
							<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
							<button type="submit" class="btn crud-submit btn-success">OK</button>
						</div>

		      		</form>

		      </div>


		    </div>

		  </div>
		</div>

		<!-- Edit Item Modal -->
		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Sửa đơn hàng</h4>
		      </div>

		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/update.php" method="put">
		      			<input type="hidden" name="id" class="edit-id">

		      			 <div class="form-group">
		                          <label for="orderid">Mã đơn hàng</label>
		                          <input type="text" id="orderid" name="orderid" placeholder="Nhập mã đơn hàng" class="form-control" readonly/>
		                      </div>

		                      <div class="form-group">
		                          <label for="name">Tên hành khách</label>
		                          <input type="text" id="name" name="name" placeholder="Nhập tên hành khách" class="form-control"/>
		                      </div>

		                      <div class="form-group">
		                          <label for="mobile">Số điện thoại</label>
		                          <input type="text" id="mobile" name="mobile" placeholder="Nhập số điện thoại" class="form-control"/>
		                      </div>
		                      <div class="form-group">
		                          <label for="email">Email</label>
		                          <input type="text" id="email" name="email" placeholder="Nhập email" class="form-control" />
		                      </div>

		      			<div class="form-group">
						<label for="date">Ngày</label>
						<input type="date" id="date" name="date" placeholder="Nhập ngày" class="form-control" />
						</div>

						<div class="form-group">
						<label for="pnr">Mã chuyến bay</label>
						<input type="text" id="pnr" name="pnr" placeholder="Nhập mã chuyến bay" class="form-control" />
						</div>
						
						<div class="form-group">
						<label for="orderfrom">Địa điểm, giờ đi</label>
						<input type="text" id="orderfrom" name="orderfrom" placeholder="Nhập địa điểm, giờ đi" class=form-control" />
						</div>
						
						<div class="form-group">
						<label for="orderto">Địa điểm, giờ đến</label>
						<input type="text" id="orderto" name="orderto" placeholder="Nhập địa đểm, giờ đến" class="form-control" />
						</div>
						
						<div class="form-group">
						<label for="Trạng thái">Trạng thái</label>
						<select name="status" id="status">
  							<option value="1">Đã gọi - Đồng ý</option>
  							<option value="2">Đã gọi - Từ chối</option>
  							<option value="3">Chưa gọi</option>
  							<option value="4">Yêu cầu gọi lại</option>
						</select>
						</div>

						<div class="form-group">
							<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
							<button type="submit" class="btn btn-success crud-submit-edit">OK</button>
						</div>

		      		</form>

		      </div>
		    </div>
		  </div>
		</div>

	</div>
</body>
</html>