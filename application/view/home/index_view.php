<?php
if(!defined('APP_PATH')){
	die('Khong the truy cap');
}
?>
	<main class="my-5">
		<div class="container">
			<h1>This is demo MVC - <?= $name; ?></h1>
			<form action="?c=login&m=handle" method="POST">
				<label for="user">User</label>
				<br>
				<input type="text" name="user" id="user">
				<br><br>
				<label for="pass">Password</label>
				<br>
				<input type="password" name="pass" id="pass">
				<br><br>
				<button type="submit" name="btnLogin">Login</button>
			</form>
			<div class="row mt-5">
				<table class="table">
					<thead>
						<tr>
							<th>MSV</th>
							<th>HT</th>
							<th>Email</th>
							<th>Dia chi</th>
							<th>Hoc bong</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['info'] as $key => $value): ?>
						<tr>
							<td><?= $value['id']; ?></td>
							<td><?= $value['name_room']; ?></td>
							<td><?= $value['type_id']; ?></td>
							<td><?= $value['status_room']; ?></td>
							<td><?= $value['description']; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>
</body>
</html>