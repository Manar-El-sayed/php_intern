<?php
@include 'connect.php';
$taskId = $_GET['edit'];
if(isset($_POST['update_task'])){
    $taskName = $_POST['taskName'];
    $description = $_POST['description'];
    $taskStatus = $_POST['taskStatus'];


    if (empty($taskName) || empty($description) || empty($taskStatus)) {
        $message[] = 'Please fill out all fields.';

    }
            $update = "UPDATE tasks SET taskName='$taskName', description='$description', taskStatus='$taskStatus'  WHERE taskId=$taskId";
            
            $upload = mysqli_query($conn, $update);

            if ($upload) {
                $message[] = 'task updated successfully.';
            } else {
                $message[] = 'Could not update this task.';
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update task</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <!-- css link  -->
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="admin-crew centered">
<div class="container ">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM tasks WHERE taskId = $taskId");
    while($row = mysqli_fetch_assoc($select)){
        ?>

            <div class="title">update task</div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <?php
               if(isset($message)){
               foreach($message as $message){
               echo '<span class="error-msg">' .$message. '</span>';
              }
             }
            ?>
            <div class="user-details">
                        <div class="input-box">
                             <span class="details">Task Name</span>
                             <input type="text" placeholder="Enter the name of task" id="taskName" value="<?php echo $row['taskName'];?>" name="taskName" required>
                         </div>
                         <div class="input-box">
                             <span class="details">Description</span>
                             <input type="text" placeholder="Enter Task Description" id="description" value="<?php echo $row['description'];?>" name="description" required>
                         </div>
                         <select id="taskStatus" name="taskStatus" required>
                             <option >Pending</option>
                             <option >In Process</option>
                             <option >Completed</option>
                        </select>

            </div>
            <div class="button">
                        <input type="submit" class="btn" name="update_task" value="update task">
                        <a href="add_task_admin.php">go back</a>
            </div>
            </form>
    <?php };?>

        </div>
</div>

</body>
</html>