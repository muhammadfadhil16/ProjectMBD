<?php
include('header.php');
include('dbcon.php');
?>

<div class="box1">
  <h2>ALL USERS</h2>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD USER</button>
  </br>
</div>

<h2>Available Rooms</h2>
<table class="table table-hover table-bordered table-striped">
  <thead>
    <tr>
      <th>Room ID</th>
      <th>Room Name</th>
      <th>Capacity</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM ruangan";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $roomStatus = ($row['kapasitas'] > 0) ? 'Available' : 'Not Available';
            echo "<tr>";
            echo "<td>" . $row['id_ruangan'] . "</td>";
            echo "<td>" . $row['nama_ruangan'] . "</td>";
            echo "<td>" . $row['kapasitas'] . "</td>";
            echo "<td>" . $roomStatus . "</td>";
            echo "</tr>";
        }
    }
    ?>
  </tbody>
</table>

<!-- Modal for adding user -->
<form action="insert_user.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD USER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select name="role" class="form-control" required>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_user" value="ADD">
      </div>
    </div>
  </div>
</div>
</form>

<?php
if(isset($_GET['message'])){
    echo "<h6>".$_GET['message']."</h6>";
}
?>

<?php
if(isset($_GET['insert_msg'])){
    echo "<h6>".$_GET['insert_msg']."</h6>";
}
?>

<?php include('footer.php'); ?>
