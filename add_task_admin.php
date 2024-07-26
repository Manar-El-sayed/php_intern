<?php
@include 'connect.php';

if (isset($_POST['add_task'])) {
    $taskName = $_POST['taskName'];
    $description = $_POST['description'];
    $taskStatus = $_POST['taskStatus'];

    if (empty($taskName) || empty($description) || empty($taskStatus)) {
        $message[] = 'Please fill out all fields.';
    } else {
        
            $insert = "INSERT INTO tasks(taskName, description, taskStatus) VALUES('$taskName','$description','$taskStatus')";
            $upload = mysqli_query($conn, $insert);

            if ($upload) {
                $message[] = 'New task added successfully.';
            } else {
                $message[] = 'Could not add this task.';
            }
        }
    }


if (isset($_GET['delete'])) {
    $taskId = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM tasks WHERE taskId = $taskId");
    header('location: add_task_admin.php');
}
 ?>



 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>To Do List</title>
     <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
     <!-- css link  -->
     <link rel="stylesheet" href="login.css">
 </head>
 <body class="crew">
 <div class="admin-crew">
     <div class="form-container">
     <div class="container">
             <div class="title">Add a task to your to-do-list</div>
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
                             <input type="text" placeholder="Enter the name of task" id="taskName" name="taskName" required>
                         </div>
                         <div class="input-box">
                             <span class="details">Description</span>
                             <input type="text" placeholder="Enter Task Description" id="description" name="description" required>
                         </div>
                        <select id="taskStatus" name="taskStatus" required>
                             <option >Pending</option>
                             <option >In Process</option>
                             <option >Completed</option>
                    </select> 
             </div>
             <div class="button">
                         <input type="submit" name="add_task" value="Add a task to your to-do list">
             </div>
             </form>
         </div>
     </div>
             <?php
            $select = mysqli_query($conn, "SELECT * FROM tasks");
             ?>
              <div class="crew-display">
                 <table class="crew-display-table">
                     <thead>
                         <tr>
                             <th>name</th>
                             <th>description</th>
                             <th>status</th>
                             <th>create date</th>
                             <th>update date</th>
                             <th>action</th>
                         </tr>
                     </thead>
                     <?php
                    while($row = mysqli_fetch_assoc($select)){
                        ?>
                        <tr>
                           <td><?php echo $row['taskName'];?></td>
                           <td><?php echo $row['description'];?></td>
                           <td><?php echo $row['taskStatus'];?></td>
                           <td><?php echo $row['createdAt'];?></td>
                           <td><?php echo $row['updatedAt'];?></td>
                           <td>
                               <a href="update_task.php?edit=<?php echo $row['taskId'];?>" class="btn"><i class="fas fa-edit"></i>edit</a>
                               <a href="add_task_admin.php?delete=<?php echo $row['taskId'];?>" class="btn"><i class="fas fa-trash"></i>delete</a>
                           </td>
                       </tr>
                       <?php };?>
               </table>

              </div>
     </div>
    
 </body>
</html>