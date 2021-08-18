<?php
session_start();
include_once("../connectDB.php");
$sql = "SELECT mov.mov_id,mov.mov_name,mov.mov_picture,mov_type.mov_type_name,mov.mov_status,mov.mov_date_start,mov.mov_date_end FROM movies mov LEFT JOIN movie_type mov_type ON mov.mov_type_id = mov_type.mov_type_id";
$query = $conn->query($sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
        <td class="order"><?= $i++; ?></td>
        <td><?= $row["mov_name"]; ?></td>
        <td><a href="#"><img src="../image/movie/<?= $row["mov_picture"]; ?>" id="imgShow" data-bs-toggle="modal" data-bs-target="#myModal" class="rounded img-sizing"></a></td>
        <td><?= $row["mov_type_name"]; ?></td>
        <td>
            <?php
            if ($row["mov_status"] == "0") {
                echo "<a href='#' id='" . $row["mov_id"] . "' name='updateStatusMovie' class='text-danger text-decoration-none'>ไม่พร้อมฉาย</a>";
            } else if ($row["mov_status"] == "1") {
                echo "<a href='#' id='" . $row["mov_id"] . "' name='updateStatusMovie' class='text-success text-decoration-none'>พร้อมฉาย</a>";
            }
            ?>
        </td>
        <td><?= $row["mov_date_start"]; ?></td>
        <td><?= $row["mov_date_end"]; ?></td>
        <td class="manage">
            <a href="movieEdit.php?id=<?= $row["mov_id"] ?>" class="btn btn-primary btn-sm">แก้ไข</a>
            <a href="#" id="<?= $row["mov_id"]; ?>" name="movDelete" class="btn btn-danger btn-sm">ลบ</a>
        </td>
    </tr>
<?php
}
$conn->close();
?>
<script>
    $(document).ready(function() {
        // ! Update สถานะภาพยนตร์
        $("a[name='updateStatusMovie']").click(function() {
            var id = $(this).attr("id");
            $.ajax({
                type: "POST",
                url: "movieController.php",
                data: {
                    id: id,
                    submit: "updateStatusMovie"
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
                                        window.location = "movie.php";
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
        $("a[name='movDelete']").click(function() {
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
                                url: "movieController.php",
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
                                                        window.location = "movie.php";
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