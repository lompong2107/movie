<?php
include_once("../connectDB.php");
$sql = "SELECT * FROM seat_type";
$query = $conn->query($sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
?>

    <tr>
        <td class="order"><?= $i++; ?></td>
        <td><?= $row["seat_type_name"]; ?></td>
        <td><?= $row["seat_type_price"]; ?></td>
        <td class="manage">
            <a href="seatTypeEdit.php?id=<?= $row["seat_type_id"]; ?>" name="seatTypeEdit" class="btn btn-primary btn-sm">แก้ไข</a>
            <a href="#" id="<?= $row["seat_type_id"]; ?>" name="seatTypeDelete" class="btn btn-danger btn-sm">ลบ</a>
        </td>
    </tr>
<?php
}
$conn->close();
?>
<script>
    $(document).ready(function() {
        $("a[name='seatTypeDelete']").click(function() {
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
                                url: "seatTypeController.php",
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
                                                        window.location = "seatType.php";
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