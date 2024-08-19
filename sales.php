<?php
session_start();

include 'includes/database.php';
include 'includes/action.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "partials/_head.php"; ?>
<body id="body">
    <div class="container">
        <!-- top navbar -->
        <nav class="navbar">
            <div class="nav_icon" onclick="toggleSidebar()">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>

            <div class="navbar__left">
                <p>Egg Sales</p>
            </div>
        </nav>

        <main>
            <div class="main__container">                
                <?php
                    if(isset($_GET["salesupdate"])){
                        // Get the id of the record to be edited
                        $id = $_GET["id"] ?? null;
                        $where = array("Sales_ID" => $id);
                        // Call the select method that displays the record to be edited
                        $row = $salesObject->selectMethod("Sales", $where);
                        ?>
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Date</label>
                                    <input type="date" name="Date" value="<?php echo $row["Date"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Number of Egg Trays</label>
                                    <input type="number" step="any" name="NumberOfEggs" value="<?php echo $row["NumberOfEggs"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Revenue</label>
                                    <input type="number" step="any" name="Revenue" value="<?php echo $row["Revenue"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="salesedit" class="btn" value="">Update</button>
                                </div>
                            </form>
                        <?php
                    }else{
                        ?>
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <label for="">Date</label>
                                    <input type="date" name="Date" value="" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Number of Egg Trays</label>
                                    <input type="number" step="any" name="NumberOfEggs" value="" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Revenue</label>
                                    <input type="number" step="any" name="Revenue" value="" required>
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="salessave" class="btn">Save</button>
                                </div>
                            </form>
                        <?php
                    }
                        ?>
                
                <table>
                    <thead>
                        <th>Date</th>
                        <th>Egg Trays</th>
                        <th>Revenue</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                    <?php
                        // calling viewMethod() method
                        $myrow = $salesObject->viewMethod("Sales");
                        foreach($myrow as $row){
                            // breaking point
                            ?>
                            <tr>
                                <td><?php echo $row['Date'];?></td>
                                <td><?php echo $row['NumberOfEggs'];?></td>
                                <td><?php echo $row['Revenue'];?></td>
                                <td>
                                    <a class="edit_btn" href="sales.php?salesupdate=1&id=<?php echo $row["Sales_ID"]; ?>">Edit</a>
                                </td>
                                <td>
                                    <a class="del_btn" href="includes/action.php?salesdelete=1&id=<?php echo $row["Sales_ID"]; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>

            </div>
        </main>
        <!-- sidebar nav -->
        <?php $currentPage = 'sales'; include "partials/_side_bar.php"; ?>
    </div>
    <script src="script.js"></script>
</body>
</html>