// ! ดูตัวอย่างรูปภาพปก
function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function () {
            $("#imagepreview").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
}

$(document).ready(function () {
    setTimeout(function () {
        $('#dataTable').DataTable();
        // ! แสดงรูป
        $("img#imgShow").click(function () {
            var path = $(this).attr("src");
            $("#imagepreview").attr("src", path);
        })
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    }, 10);

    // ! Sub-Menu ของ Sidebars
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
})