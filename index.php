<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CRUD Customer Information</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"><br>
                <h3>รายชื่อลูกค้า <a href="addcustomer_dropdown.php" class="btn btn-info float-end">+เพิ่มข้อมูล</a></h3>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>รหัสลูกค้า</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>วันเกิด</th>
                            <th>อีเมล</th>
                            <th>ประเทศ</th>
                            <th>ยอดหนี้</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "connect.php";

                        $sql = "SELECT customer.CustomerID, customer.Name, customer.Birthdate, customer.Email, country.CountryName, customer.OutstandingDebt
                                FROM customer, country
                                WHERE customer.CountryCode = country.CountryCode";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['CustomerID'] ?></td>
                                <td><?= $r['Name'] ?></td>
                                <td><?= $r['Birthdate'] ?></td>
                                <td><?= $r['Email'] ?></td>
                                <td><?= $r['CountryName'] ?></td>
                                <td><?= $r['OutstandingDebt'] ?></td>
                                <td><a href="updateCustomerForm.php?CustomerID=<?= $r['CustomerID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="deleteCustomer.php?CustomerID=<?= $r['CustomerID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>