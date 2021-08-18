<?php
include_once("../connectDB.php");
$sql = "SELECT * FROM movie_type";
$query = $conn->query($sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {
?>

    <tr>
        <td class="order"><?= $i++; ?></td>
        <td><?= $row["mov_type_name"]; ?></td>
        <td class="manage">
            <a href="movieTypeEdit.php?id=<?= $row["mov_type_id"]; ?>" name="movTypeEdit" class="btn btn-primary btn-sm">แก้ไข</a>
            <a href="#" id="<?= $row["mov_type_id"]; ?>" name="movTypeDelete" class="btn btn-danger btn-sm">ลบ</a>
        </td>
    </tr>

    <script>
        $(document).ready(function() {
            $("a[name='movTypeDelete']").click(function() {
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
                                console.log(id + name);
                                $.ajax({
                                    type: "POST",
                                    url: "movieTypeController.php",
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
                                                            window.location = "movieType.php";
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
<?php
}
$conn->close();
?>