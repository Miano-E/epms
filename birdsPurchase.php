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
                <p>Birds Purchase</p>
            </div>
        </nav>

        <main>
            <div class="main__container">
                <?php
                    if(isset($_GET["birdspurchupdate"])){
                        // Get the id of the record to be edited
                        $id = $_GET["id"] ?? null;
                        $where = array("BirdsPurchase_ID" => $id);
                        // Call the select method that displays the record to be edited
                        $row = $birdsPurchaseObject->selectMethod("BirdsPurchase", $where);
                        ?>
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="">Date</label>
                                    <input id="BPDate" type="date" name="Date" value="<?php echo $row["Date"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Number of Birds</label>
                                    <input type="number" step="any" name="NumberOfBirds" value="<?php echo $row["NumberOfBirds"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Price</label>
                                    <input type="number" step="any" name="Price" value="<?php echo $row["Price"]; ?>" required>
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="birdspurchedit" class="btn" value="">Update</button>
                                </div>
                            </form>
                        <?php
                    }else{
                        ?>  
                            <form action="includes/action.php" method="post">
                                <div class="input-group">
                                    <label for="">Date</label>
                                    <input id="BPDate" type="date" name="Date" value="" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Number of Birds</label>
                                    <input type="number" step="any" name="NumberOfBirds" value="" required>
                                </div>
                                <div class="input-group">
                                    <label for="">Price</label>
                                    <input type="number" step="any" name="Price" value="" required>
                                </div>
                                <div class="input-group">
                                    <button type="submit" name="birdspurchsave" class="btn">Save</button>
                                </div>
                            </form>
                        <?php
                    }
                        ?>

                <table>
                    <thead>
                        <th>Date</th>
                        <th>Birds</th>
                        <th>Price</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                    <?php
                        // calling viewMethod() method
                        $myrow = $birdsPurchaseObject->viewMethod("BirdsPurchase");
                        foreach($myrow as $row){
                            // breaking point
                            ?>
                            <tr>
                                <td><?php echo $row['Date'];?></td>
                                <td><?php echo $row['NumberOfBirds'];?></td>
                                <td><?php echo $row['Price'];?></td>
                                <td>
                                    <a class="edit_btn" href="birdsPurchase.php?birdspurchupdate=1&id=<?php echo $row["BirdsPurchase_ID"]; ?>">Edit</a>
                                </td>
                                <td>
                                    <a class="del_btn" href="includes/action.php?birdspurchdelete=1&id=<?php echo $row["BirdsPurchase_ID"]; ?>">Delete</a>
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
        <?php $currentPage = 'purchase'; include "partials/_side_bar.php"; ?>
    </div>
    <script src="script.js"></script>
</body>
</html>