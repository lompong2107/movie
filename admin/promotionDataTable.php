<?php
session_start();
include_once("../connectDB.php");
$sql = "SELECT * FROM promotion";
$query = $conn->query($sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
        <td class="order"><?= $i++; ?></td>
        <td>
            <span class="d-inline-block text-truncate" style="max-width: 300px;" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="<?= $row["pro_title"]; ?>">
                <?= $row["pro_title"]; ?>
            </span>
        </td>
        <td><a href="#"><img src="../image/promotion/<?= $row["pro_image"]; ?>" id="imgShow" data-bs-toggle="modal" data-bs-target="#myModal" class="rounded img-sizing"></a></td>
        <td>
            <span class="text-truncate d-inline-block" style="max-width: 300px;" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="<?= $row["pro_detail"]; ?>">
                <?= $row["pro_detail"]; ?>
            </span>
        </td>
        <td><?= $row["pro_date_start"]; ?></td>
        <td><?= $row["pro_date_end"]; ?></td>
        <td class="manage">
            <a href=" promotionEdit.php?id=<?= $row["pro_id"] ?>" class="btn btn-primary btn-sm">แก้ไข</a>
            <a href="#" id="<?= $row["pro_id"]; ?>" name="proDelete" class="btn btn-danger btn-sm">ลบ</a>
        </td>
    </tr>
<?php
}
$conn->close();
?>
<script>
    $(document).ready(function() {
        $("a[name='proDelete']").click(function() {
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
                                url: "promotionController.php",
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
                                                        window.location = "promotion.php";
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