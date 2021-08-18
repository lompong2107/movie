<?php
session_start();
include_once("../connectDB.php");
$sqlCycDetail = "SELECT * FROM cycle_detail cyc_det LEFT JOIN movies mov ON cyc_det.mov_id = mov.mov_id LEFT JOIN cinema cin ON cyc_det.cin_id = cin.cin_id WHERE cin.branch_id = " . $_SESSION["branch_id"];
$queryCycDetail = $conn->query($sqlCycDetail);
$i = 1;
while ($row = mysqli_fetch_assoc($queryCycDetail)) {
?>
    <tr>
        <td class="order"><?= $i++; ?></td>
        <td><?= $row["mov_name"]; ?></td>
        <td>โรงภาพยนตร์ <?= $row["cin_name"]; ?></td>
        <td><?= $row["cyc_date"]; ?></td>
        <td class="cycTime align-self-center">
            <?php
            $sqlCyc = "SELECT * FROM cycle WHERE cyc_id = " . $row["cyc_id"] . " ORDER BY cyc_time";
            $queryCyc = $conn->query($sqlCyc);
            while ($rowCyc = mysqli_fetch_assoc($queryCyc)) { ?>
                <div class="alert alert-dark py-0" role="alert">
                    <span class="align-middle"><?= $rowCyc["cyc_time"]; ?></span>
                </div>
            <?php } ?>
        </td>
        <td class="manage">
            <a href="cycleEdit.php?id=<?= $row["cyc_id"]; ?>" name="cycEdit" class="btn btn-primary btn-sm">แก้ไข</a>
            <a href="#" id="<?= $row["cyc_id"]; ?>" name="cycDelete" class="btn btn-danger btn-sm">ลบ</a>
        </td>
    </tr>
<?php
}
$conn->close();
?>
<script>
    $(document).ready(function() {
        $("a[name='cycDelete']").click(function() {
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
                                url: "cycleController.php",
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
                                                        window.location = "cycle.php";
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