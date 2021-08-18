<?php
session_start();
include_once("../connectDB.php");
$sql = "SELECT seat.*, cinema.*, seat_type.* FROM seat LEFT JOIN cinema ON seat.cin_id = cinema.cin_id LEFT JOIN seat_type ON seat.seat_type_id = seat_type.seat_type_id WHERE seat.cin_id IN (SELECT cin_id FROM cinema WHERE branch_id = " . $_SESSION["branch_id"] . ")";
$query = $conn->query($sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
?>

    <tr>
        <td class="order"><?= $i++; ?></td>
        <td>โรงภาพยนตร์ <?= $row["cin_name"]; ?></td>
        <td><?= $row["seat_type_name"]; ?></td>
        <td><?= $row["seat_row"]; ?></td>
        <td><?= $row["seat_amount"]; ?></td>
        <td class="manage">
            <a href="seatEdit.php?id=<?= $row["seat_id"]; ?>" name="seatEdit" class="btn btn-primary btn-sm">แก้ไข</a>
            <a href="#" id="<?= $row["seat_id"]; ?>" name="seatDelete" class="btn btn-danger btn-sm">ลบ</a>
        </td>
    </tr>
<?php
}
$conn->close();
?>
<script>
    $(document).ready(function() {
        $("a[name='seatDelete']").click(function() {
            var id = $(this).attr("id");
            var name = $(this).attr("name");
            $.confirm({
                title: 'ต้องการลบหรือไม่?',
                content: 'ดำเนินการต่อ...',
                buttons: {
                    confirm: {
                        text: 'ตกลง',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                type: "POST",
                                url: "seatController.php",
                                data: {
                                    id: id,
                                    submit: name
                                },
                                success: function(response) {
                                    if (response.status == 1) {
                                        $.confirm({
                                            title: "สำเร็จ!",
                                            content: "",
                                            buttons: {
                                                confirm: {
                                                    text: 'ตกลง',
                                                    action: function() {
                                                        window.location = "seat.php";
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        $.alert("ล้มเหลว!");
                                    }
                                }
                            })
                        }
                    },
                    back: {
                        text: 'กลับ',
                        btnClass: 'btn-blue'
                    }
                }
            });
        })
    })
</script>