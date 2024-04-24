<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <?php include_once 'layouts/head.php' ?>
</head>

<body>
    <?php include_once 'layouts/top_nav.php' ?>
    <?php include_once 'layouts/header.php' ?>
    <?php include_once 'layouts/search.php' ?>

    <!-- Start Content -->
    <div class="container py-5">
        <div class="d-sm-flex justify-content-end mb-2 row">
            <div class="col-sm-12 col-md-4">
                <button type="button" class="btn btn-success w-100 btn-block" data-bs-toggle="modal" data-bs-target="#form_create_data">
                    เพิ่มหมวดหมู่
                </button>
            </div>
        </div>

        <div class="row">
            <table id="datatables" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>รหัสหมวดหมู่</th>
                        <th>ชื่อหมวดหมู่</th>
                        <th>ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>สินค้าที่ 1</td>
                        <td>
                            <button>แก้ไข</button>
                            <button>ลบ</button>
                        </td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>สินค้าที่ 2</td>
                        <td>
                            <button>แก้ไข</button>
                            <button>ลบ</button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>สินค้าที่ 3</td>
                        <td>
                            <button>แก้ไข</button>
                            <button>ลบ</button>
                        </td>
                    </tr>
                    <tr>
                        <td>004</td>
                        <td>สินค้าที่ 4</td>
                        <td>
                            <button>แก้ไข</button>
                            <button>ลบ</button>
                        </td>
                    </tr>
                    <tr>
                        <td>005</td>
                        <td>สินค้าที่ 5</td>
                        <td>
                            <button>แก้ไข</button>
                            <button>ลบ</button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
    <!-- End Content -->

    <!-- Modal -->
    <div class="modal fade" id="form_create_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="create_data_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มหมวดหมู่</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput">ชื่อหมวดหมู่</label>
                            <input type="text" class="form-control" name="category_name" id="category_name" placeholder="ชื่อหมวดหมู่" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="form_update_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="update_data_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขหมวดหมู่</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput">ชื่อหมวดหมู่</label>
                            <input type="text" class="form-control" name="category_name" id="category_name_edit" placeholder="ชื่อหมวดหมู่" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php include_once 'layouts/footer.php' ?>
    <?php include_once 'layouts/script.php' ?>
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "scrollX": true
            });
        });
    </script>
</body>

</html>