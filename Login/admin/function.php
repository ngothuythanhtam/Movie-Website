<?php
include 'connect.php';
function check($email, $psswd, $id)
{
	global $conn;
	$user = $conn->prepare("SELECT email,psswd FROM users WHERE email=? AND psswd =?");
	$admin = $conn->prepare("SELECT email,psswd,id FROM admins WHERE email=? AND psswd = ? AND id =?");
	$wrongpass = $conn->prepare("SELECT email,psswd FROM users WHERE email=? AND psswd != ?");
	$wrongpassad = $conn->prepare("SELECT email, psswd FROM admins WHERE email = ? AND (psswd != ? OR id != ?)");

	$user->bind_param("ss", $email, $psswd);
	$user->execute();
	$userResult = $user->get_result();

	$admin->bind_param("ssi", $email, $psswd, $id);
	$admin->execute();
	$adminResult = $admin->get_result();

	$wrongpass->bind_param("ss", $email, $psswd);
	$wrongpass->execute();
	$wrongpassResult = $wrongpass->get_result();

	$wrongpassad->bind_param("ssi", $email, $psswd, $id);
	$wrongpassad->execute();
	$wrongpassadResult = $wrongpassad->get_result();

	if ($userResult->num_rows > 0)
		return 1;
	else if ($adminResult->num_rows > 0)
		return 2;
	else if ($wrongpassResult->num_rows > 0)
		return 3;
	else if ($wrongpassadResult->num_rows > 0)
		return 4;
	else
		return 0;
}
function checkemail($email)
{
	global $conn;
	$user = $conn->prepare("SELECT email FROM users WHERE email=?");
	$admin = $conn->prepare("SELECT email FROM admins WHERE email=?");

	$user->bind_param("s", $email);
	$user->execute();
	$userResult = $user->get_result();

	$admin->bind_param("s", $email);
	$admin->execute();
	$adminResult = $admin->get_result();

	if ($userResult->num_rows != 0 || $adminResult->num_rows > 0) {
		return 0;
	} else
		return 1;
}

function getall()
{
	global $conn;
	$result = $conn->query("SELECT * FROM movies");
	while ($row = $result->fetch_assoc()) {
		?>
		<tr>
			<td><?php echo $row['movie_id']; ?></td>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['g_id']; ?></td>
			<td><?php echo $row['episodes']; ?></td>
			<?php if ($row['status'] == 0): ?>
				<td id="status1"><ion-icon name="radio-button-off-outline"></ion-icon><span>Processing</span></td>
			<?php else: ?>
				<td id="status2"><ion-icon name="radio-button-on-outline"></ion-icon><span>Completely</span></td>
			<?php endif; ?>
			<td>
				<a href="index.php?id=<?php echo $row['movie_id']; ?>" class="update"><i
						class="fa-solid fa-pen-to-square"></i>Update</a>|
				<a href="result.php?act=delete&id=<?php echo $row['movie_id']; ?>" class="remove"
					onclick="return confirm('Are you sure want to delete this movie?')"><i
						class="fa-solid fa-trash"></i>Remove</a>
			</td>
		</tr>
		<?php
	}
}
function gethome()
{
	global $conn;
	$result = $conn->query("SELECT * FROM movies");
	while ($row = $result->fetch_assoc()) {
		?>
		<tr>
			<td><?php echo $row['movie_id']; ?></td>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['g_id']; ?></td>
			<td><?php echo $row['episodes']; ?></td>
			<?php if ($row['status'] == 0): ?>
				<td id="status1"><ion-icon name="radio-button-off-outline"></ion-icon><span>Processing</span></td>
			<?php else: ?>
				<td id="status2"><ion-icon name="radio-button-on-outline"></ion-icon><span>Completely</span></td>
			<?php endif; ?>
		</tr>
		<?php
	}
}
function delete()
{
	global $conn;
	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$stmt = $conn->prepare("DELETE FROM movies WHERE movie_id = ?");
		$stmt->bind_param("i", $id); // i là kiểu dữ liệu của $id (integer)
		$stmt->execute();
		echo "<script>alert('Delete successfully!');</script>";
	}
}

?>