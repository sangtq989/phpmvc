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
				<?php if($errorAddData): ?>
					<ul>
						<?php foreach($errorAddData as $err): ?>
							<?php if($err): ?>
								<li style="color: red;"><?= $err; ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<form action="?c=admin&m=handleAdd" method="POST" class="mt-5">					
				  <div class="form-group">
				    <label for="txtUser">User name</label>
				    <input type="text" class="form-control" id="txtUser" name="username">
				  </div>

				  <div class="form-group">
				    <label for="txtPass">Password</label>
				    <input type="password" class="form-control" id="txtPass" name="password" placeholder="Password">
				  </div>
				  
				  <div class="form-group">
				    <label for="txtEmail">Email</label>
				    <input type="text" class="form-control" id="txtEmail" name="email" placeholder="Email">
				  </div>

				  <div class="form-group">
				    <label for="txtPhone">Phone</label>
				    <input type="text" class="form-control" id="txtPhone" name="phone" placeholder="Phone">
				  </div>

				  <div class="form-group">
				    <label for="txtRole">Phone</label>
				    <select name="role" id="txtRole" class="form-control">
				    	<option value="-1">Super admin</option>
				    	<option value="1">admin</option>
				    </select>				    
				  </div>

				  <div class="form-group">
				    <label for="txtAddress">Address</label>
				   <textarea class="form-control" id="txtAddress" name="address" rows="5"></textarea>
				  </div>

				  <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
				</form>
			
			</div>
		</div>
	</div>
</main>