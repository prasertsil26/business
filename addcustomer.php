<html>

<head>
    <title>User Registration11</title>
</head>

<body>

    <h1>Add Customer</h1>

    <form action="addcustomer.php" method="POST">

        <input type="text" placeholder="Enter Customer ID" name="customerID">
        <br><br>

        <input type="text" placeholder="Name" name="Name">
        <br><br>

        <input type="date" placeholder="Birthdate" name="birthdate">
        <br><br>

        <input type="email" placeholder="Email" name="email">
        <br><br>

        <input type="text" placeholder="Country code" name="countryCode">
        <br><br>

        <input type="number" placeholder="OutStanding debt" name="outstandingDebt">

        <input type="submit">

    </form>

</body>

</html>

<?php

if (isset($_POST['customerID']) && isset($_POST['Name'])) {

    echo "<br>" .
        $_POST['customerID'] .
        $_POST['Name'] .
        $_POST['birthdate'] .
        $_POST['email'] .
        $_POST['countryCode'] .
        $_POST['outstandingDebt'];

    require 'connect.php';

    $sql = "insert into customer values
            (:customerID, :Name, :birthdate, :email, :countryCode, :outstandingDebt)";

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


$Conn = null;

?>