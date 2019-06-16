<?php 
if (!defined('APP_PATH')) {
	die('cant access');
}
?>
<main class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xl-12">
				<h2 class="text-center">Form add admin</h2>
			
				<form action="?c=admin&m=handleEdit&id=<?= $info['id']?>" method="POST" class="mt-5">					
				  <div class="form-group">
				    <label for="txtUser">User name</label>
				    <input type="text" class="form-control" id="txtUser" name="username" value="<?=$info['username']?>">
				  </div>

				  <div class="form-group">
				    <label for="txtPass">Password</label>
				    <input type="password" class="form-control" id="txtPass" name="password" value="<?=$info['password']?>" placeholder="Password">
				  </div>
				  
				  <div class="form-group">
				    <label for="txtEmail">Email</label>
				    <input type="text" class="form-control" id="txtEmail" name="email" value="<?=$info['email']?>" placeholder="Email">
				  </div>

				  <div class="form-group">
				    <label for="txtPhone">Phone</label>
				    <input type="text" class="form-control" id="txtPhone" name="phone" value="<?=$info['phone']?>">
				  </div>

				  <div class="form-group">
				    <label for="txtRole">Role</label>
				    <select name="role" id="txtRole" class="form-control">
				    	<option value="-1" <?=$info['role'] == -1 ? "selected" : "";?> >Super admin</option>
				    	<option value="1"  <?=$info['role'] == 1 ? "selected" : "";?> >admin</option>
				    </select>				    
				  </div>
				  <div class="form-group">
				    <label for="txtRole">Status</label>
				    <select name="role" id="txtRole" class="form-control">
				    	<option value="1" <?=$info['status'] == 1 ? "selected" : "";?> >Active</option>
				    	<option value="0"  <?=$info['status'] == 0 ? "selected" : "";?> >Deactive</option>
				    </select>				    
				  </div>

				  <div class="form-group">
				    <label for="txtAddress">Address</label>
				   <textarea class="form-control" id="txtAddress" name="address" rows="5">
				   		<?=$info['address']?>
				   </textarea>
				  </div>

				  <button type="submit" class="btn btn-primary" name="btnSubmit">Edit</button>
				</form>
			
			</div>
		</div>
	</div>
</main>