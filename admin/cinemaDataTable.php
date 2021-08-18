<?php
session_start();
include_once("../connectDB.php");
$sql = "SELECT * FROM cinema WHERE branch_id = " . $_SESSION["branch_id"];
$query = $conn->query($sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
?>

    <tr>
        <td class="order"><?= $i++; ?></td>
        <td>โรงภาพยนตร์ <?= $row["cin_name"]; ?></td>
        <td>
            <?php
            if ($row["cin_status"] == "0") {
                echo "<a href='#' id='" . $row["cin_id"] . "' name='updateStatusCinema' class='text-danger text-decoration-none'>ไม่พร้อมใช้งาน</a>";
            } else if ($row["cin_status"] == "1") {
                echo "<a href='#' id='" . $row["cin_id"] . "' name='updateStatusCinema' class='text-success text-decoration-none'>พร้อมใช้งาน</a>";
            }
            ?>
        </td>
        <td class="manage">
            <a href="cinemaEdit.php?id=<?= $row["cin_id"]; ?>" name="cinEdit" class="btn btn-primary btn-sm">แก้ไข</a>
            <a href="#" id="<?= $row["cin_id"]; ?>" name="cinDelete" class="btn btn-danger btn-sm">ลบ</a>
        </td>
    </tr>
<?php
}
$conn->close();
?>
<script>
    $(document).ready(function() {
        // ! Update สถานะภาพยนตร์
        $("a[name='updateStatusCinema']").click(function() {
            var id = $(this).attr("id");
            $.ajax({
                type: "POST",
                url: "cinemaController.php",
                data: {
                    id: id,
                    submit: "updateStatusCinema"
                },
                success: function(response) {
                    if (response.status == 1) {
                        $.confirm({
                            title: "สำเร็จ!",
                            content: "เปลี่ยนสถานะสำเร็จ",
                            buttons: {
                                confirm: {
                                    text: "ตกลง",
                                    action: function() {
                                        window.location = "cinema.php";
                                    }
                                }
                            }
                        })
                    } else {
                        $.confirm({
                            title: "ล้มเหลว!",
                            content: "เปลี่ยนสถานะไม่สำเร็จ",
                            buttons: {
                                confirm: {
                                    text: "ตกลง"
                                }
                            }
                        })
                    }
                }
            })
        })

        // ! ปุ่มลบภาพยนตร์
        $("a[name='cinDelete']").click(function() {
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
                                url: "cinemaController.php",
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
                                                        window.location = "cinema.php";
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