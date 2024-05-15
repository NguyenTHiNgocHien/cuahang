<?php
include_once 'lib/session.php';
Session::checkSession('client');
include_once 'classes/cart.php';
include_once 'classes/orderDetails.php';

$cart = new cart();
$orderDetails = new orderDetails();

$totalQty = $cart->getTotalQtyByUserId();
$result = $orderDetails->getOrderDetails($_GET['orderId']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://use.fontawesome.com/2145adbb48.js"></script>
    <script src="https://kit.fontawesome.com/a42aeb5b72.js" crossorigin="anonymous"></script>
    <title>Order</title>
</head>

<body>
    <section class="top">
        <div class="top-container">
            <div class="row">
                <div class="top-logo"><img src="images/logo1.jpg" alt="" width="160px" height="auto"></div>

                <div class="menu">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="productList.php">Sản phẩm</a></li>
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                <li><a href="logout.php" id="signin">Đăng xuất</a></li>
            <?php } else { ?>
                <li><a href="register.php" id="signup">Đăng ký</a></li>
                <li><a href="login.php" id="signin">Đăng nhập</a></li>
            <?php } ?>
            <li><a href="order.php" id="order">Đơn hàng</a></li>
                </div>   
                <div class="top-menu-icons">
                    <ul>
                        <li>
                            <input type="text" placeholder="Tìm kiếm">
                            <i class="fas fa-search"></i>
                        </li>
                    <li>
                <a href="checkout.php">
                    <i class="fa fa-shopping-bag" style="color: #551A8B;"></i>
                    <span style="color: #551A8B;" class="sumItem">
                        <?= ($totalQty['total']) ? $totalQty['total'] : "0" ?>
                    </span>
                </a>
            </li>
                    </ul>

                </div>
            </div>     
        </div>
    </section>
    <section class="sliders"></section>
    <section class="product-container"></section>
    <div class="featuredProducts">
        <h1>Chi tiết đơn hàng <?= $_GET['orderId'] ?></h1>
    </div>
    <div class="container-single">
        <table class="order">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
            </tr>
            <?php $count = 1;
            foreach ($result as $key => $value) { ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $value['productName'] ?></td>
                    <td><img class="image-cart" src="admin/uploads/<?= $value['productImage'] ?>" alt=""></td>
                    <td><?= number_format($value['productPrice'], 0, '', ',') ?>VND</td>
                    <td><?= $value['qty'] ?></td>
                </tr>
            <?php }
            ?>
        </table>

    </div>
    </div>
    <footer>
        <div class="social">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
        <ul class="list">
          
        </ul>
        <p class="copyright">
            <li>   Địa chỉ: Số 23 Đường Cát Bi , Thành Tô , Hải An Hải Phòng </li>
                    <li>Điện thoại: 028 6680 4323 -  Hotline:  0935 051 068 </li>
                    <li>Email:  admin@gmail.com</li></p></p>
    </footer>
</body>

</html>