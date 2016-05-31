<?php include("../header.php");?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
			<fieldset style="color: white;"><center>
			<h3><b><?php echo $_SESSION["name"];?>'s Profile</b></h3>
				<table class="table">
					<thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Password</th></tr></thead>
					<tr>
						<td><?php echo $_SESSION["name"];?></td>
						<td><?php echo $_SESSION["email"];?></td>
						<td><?php echo $_SESSION["phone"];?></td>
						<td><?php echo $_SESSION["password"];?></td>
						<td><?php echo $_SESSION["address"]; ?></td>
					</tr>
				</table></center>

			</fieldset>
			</div>
		</div>
	</div>
</section>