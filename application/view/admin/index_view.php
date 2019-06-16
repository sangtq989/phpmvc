<?php 
if (!defined('APP_PATH')) {
	die('cant access');
}
?>
<main class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				
				<input type="text" id="txtKeyword" value="<?=$keyword;?>">
				<button id="btnSearch">seach</button>
				<a href="?c=admin" class="btn btn-primary">View all</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-xl-12">
				<h2 class="text-center">This is Admin</h2>
				<a href="?c=admin&m=add" class="btn btn-primary">Add admin</a>
				<table class="table">
					
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Email</th>
							<th>Role</th>							
							<th>Status</th>
							<th>Phone</th>
							<th>Address</th>
							<th width="5%" colspan="2">Action</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach ($infoAdmins as $key => $item):  ?>
						<tr>
							<td><?= $key + 1; ?></td>
							<td><?= $item['username']; ?></td>
							<td><?= $item['email']; ?></td>
							<td><?= $item['role']==-1 ? "Super admin":"Admin"; ?></td>
							<td><?= $item['status']==1 ? "Active":"Deactive"; ?></td>
							<td><?= $item['phone']; ?></td>
							<td><?= $item['address']; ?></td>
							
							<td>
								 <a href="?c=admin&m=edit&id=<?=$item['id'];?>" class="btn btn-primary" class="btnEdit" >Edit</a>
								<!-- <a href="?c=admin&m=delete&id=<?=$item['id'];?>"  class="btnDelete">Delete</a> -->
							</td>	
							<td>
								<form action="?c=admin&m=delete" method="POST">
									<input type="hidden" name="idAdmin" value="<?=$item['id'];?>">
									<button type="submit" class="btn btn-danger" name="btnDelete">Delete</button>
								</form>
								
							</td>

						</tr>
						<?php endforeach ?>
					</tbody>
				</table>

			</div>
			<div class="mt-3 col-lg-12 col-xl-12">
				<?=$panigation?>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$(function () {
			$('#btnSearch').click(function () {
				let keyword = $('#txtKeyword').val().trim();
				if (keyword.length >2 ) {
					window.location.href = "?c=admin&m=index&keyword="+keyword;
				}else{
					alert('nhap tu khoa');
				}
			});
		});
	</script>
</main>