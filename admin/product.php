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
                    เพิ่มสินค้า
                </button>
            </div>
        </div>

        <div class="row">
            <table id="datatables" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>หมวดหมู่</th>
                        <th>ราคาเริ่มต้น</th>
                        <th>ราคาปัจจุบัน</th>
                        <th>วันที่เริ่มต้น</th>
                        <th>วันที่สิ้นสุด</th>
                        <th>สถานะ</th>
                        <th>ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../connect/connect.php';
                    $stmt = $conn->query("SELECT * FROM products INNER JOIN categories ON products.category_code = categories.category_code WHERE products.is_deleted = 0");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?= $row['product_code'] ?></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['category_name'] ?></td>
                            <td><?= $row['starting_price'] ?></td>
                            <td><?= $row['current_price'] ?></td>
                            <td><?= $row['start_datetime'] ?></td>
                            <td><?= $row['end_datetime'] ?></td>
                            <?php
                            $status = $row['bid_status'];
                            $status_text = '';
                            $status_color = '';

                            switch ($status) {
                                case 1:
                                    $status_text = 'ACTIVE';
                                    $status_color = 'success';
                                    break;
                                case 2:
                                    $status_text = 'CLOSED';
                                    $status_color = 'danger';
                                    break;
                                case 3:
                                    $status_text = 'SOLD';
                                    $status_color = 'primary';
                                    break;
                                case 4:
                                    $status_text = 'EXPIRED';
                                    $status_color = 'warning';
                                    break;
                                default:
                                    $status_text = 'UNKNOWN';
                                    $status_color = 'secondary';
                            }
                            ?>

                            <td><button type="button" class="btn btn-<?php echo $status_color; ?>"><?php echo $status_text; ?></button></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><button class="dropdown-item edit_data" data-id="<?= $row['product_code'] ?>" data-name="<?= $row['product_name'] ?>" data-category="<?= $row['category_code'] ?>" data-description="<?= $row['description'] ?>" data-starting-price="<?= $row['starting_price'] ?>" data-current-price="<?= $row['current_price'] ?>" data-start-datetime="<?= $row['start_datetime'] ?>" data-end-datetime="<?= $row['end_datetime'] ?>">แก้ไข</button></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><button class="dropdown-item delete_data" data-id="<?= $row['product_code'] ?>">ลบ</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
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
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product_name">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="ชื่อสินค้า" required>
                        </div>
                        <div class="form-group">
                            <label for="category_code">หมวดหมู่</label>
                            <select class="form-control" name="category_code" id="category_code" required>
                                <option value="">เลือกหมวดหมู่</option>
                                <?php
                                $stmt = $conn->query("SELECT * FROM categories WHERE is_deleted = 0");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $row['category_code'] ?>"><?= $row['category_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">รายละเอียด</label>
                            <textarea class="form-control" name="description" id="description" placeholder="รายละเอียด"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="starting_price">ราคาเริ่มต้น</label>
                            <input type="text" class="form-control" name="starting_price" id="starting_price" placeholder="ราคาเริ่มต้น" required>
                        </div>
                        <div class="form-group">
                            <label for="start_datetime">วันที่เริ่มต้น</label>
                            <input type="datetime-local" class="form-control" name="start_datetime" id="start_datetime" required>
                        </div>
                        <div class="form-group">
                            <label for="end_datetime">วันที่สิ้นสุด</label>
                            <input type="datetime-local" class="form-control" name="end_datetime" id="end_datetime" required>
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
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_code" id="product_code_edit" placeholder="ชื่อสินค้า" required>
                        <div class="form-group">
                            <label for="formGroupExampleInput">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="product_name" id="product_name_edit" placeholder="ชื่อสินค้า" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">หมวดหมู่</label>
                            <select class="form-control" name="category_code" id="category_code_edit" required>
                                <?php
                                $stmt = $conn->query("SELECT * FROM categories WHERE is_deleted = 0");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($row['category_code'] == $category_code) ? 'selected' : '';
                                ?>
                                    <option value="<?= $row['category_code'] ?>" <?= $selected ?>><?= $row['category_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">รายละเอียด</label>
                            <textarea class="form-control" name="description" id="description_edit" placeholder="รายละเอียด"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">ราคาเริ่มต้น</label>
                            <input type="text" class="form-control" name="starting_price" id="starting_price_edit" placeholder="ราคาเริ่มต้น" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="formGroupExampleInput">ราคาปัจจุบัน</label>
                            <input type="text" class="form-control" name="current_price" id="current_price_edit" placeholder="ราคาปัจจุบัน">
                        </div> -->
                        <div class="form-group">
                            <label for="formGroupExampleInput">วันที่เริ่มต้น</label>
                            <input type="datetime-local" class="form-control" name="start_datetime" id="start_datetime_edit" placeholder="วันที่เริ่มต้น" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">วันที่สิ้นสุด</label>
                            <input type="datetime-local" class="form-control" name="end_datetime" id="end_datetime_edit" placeholder="วันที่สิ้นสุด" required>
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
    <script src="js/product.js"></script>
</body>

</html>