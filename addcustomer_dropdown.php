<?php
require 'connect.php';

$sql_select = "select * from country order by countryCode";
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();

?>
<html>

<head>
    <title>User Registration</title>
</head>

<body>
    <h1>Add customer but not in order of columns</h1>

    <form action="addcustomer_dropdown.php" method="POST">

        <input type='text' placeholder='Enter Customer ID' name="customerID">
        <br><br>

        <input type="text" placeholder="Name" name="Name">
        <br><br>

        <input type="number" placeholder="Outstanding debt" name="outstandingDebt">
        <br><br>

        <input type="email" placeholder="Email" name="email">
        <br><br>

        <input type="date" placeholder="Birthdate" name="birthdate">
        <br><br>

        <label>Select a country code</label>
        <select name="countryCode">

            <?php


            //https://www.w3schools.com/tags/tag_select.asp
            while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)):;

            ?>

                <option value="<?php echo $cc["CountryCode"]; ?>">
                    <?php echo $cc["CountryName"]; ?>
                </option>

            <?php
            endwhile;
            ?>

        </select>

        <br><br>

        <input type="submit" value="Submit" name="submit" />

    </form>

</body>

</html>

<?php


if (isset($_POST['submit'])) {

    if (!empty($_POST['customerID']) && !empty($_POST['Name'])) {
        //echo '<br>'.$_POST['customerID'];

        //ฝึกสลับตำแหน่งการ insert ในภาษา SQL
        $sql = "insert into customer (customerID,Name,countryCode,outstandingDebt,email, birthdate)
values (:customerID, :Name, :countryCode,
:outstandingDebt, :email,:birthdate)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':customerID', $_POST['customerID']);
        $stmt->bindParam(':Name', $_POST['Name']);
        $stmt->bindParam(':birthdate', $_POST['birthdate']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':countryCode', $_POST['countryCode']);
        $stmt->bindParam(':outstandingDebt', $_POST['outstandingDebt']);

        if ($stmt->execute()):

            $message = 'Successfully add new customer';
        else:

            $message = 'Fail to add new customer';
        endif;

        echo $message;
    }
}
$Conn = null;

?>