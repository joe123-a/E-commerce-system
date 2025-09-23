<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- Dashboard -->
                <div class="sb-sidenav-menu-heading">Dashboard</div>
                <?= Html::a('<div class="sb-nav-link-icon"><i class="mdi mdi-grid-large"></i></div>Dashboard', 
                    Url::to(['administrator/dashboard']), 
                    ['class' => 'nav-link']
                ) ?>

                <!-- E-commerce Management -->
                <div class="sb-sidenav-menu-heading">E-commerce Management</div>

                <!-- Products -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                    <div class="sb-nav-link-icon"><i class="mdi mdi-package-variant"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProducts" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?= Html::a('All Products', Url::to(['products/index']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Add Product', Url::to(['products/create']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Categories', Url::to(['category/index']), ['class'=>'nav-link']) ?>
                    </nav>
                </div>

                <!-- Orders -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrders" aria-expanded="false" aria-controls="collapseOrders">
                    <div class="sb-nav-link-icon"><i class="mdi mdi-cart-outline"></i></div>
                    Orders
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseOrders" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?= Html::a('All Orders', Url::to(['order/index']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Pending Orders', Url::to(['order/pending']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Shipped Orders', Url::to(['order/shipped']), ['class'=>'nav-link']) ?>
                    </nav>
                </div>

                <!-- Customers -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseCustomers">
                    <div class="sb-nav-link-icon"><i class="mdi mdi-account-group"></i></div>
                    Customers
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCustomers" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?= Html::a('All Customers', Url::to(['customer/index']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Add Customer', Url::to(['customer/create']), ['class'=>'nav-link']) ?>
                    </nav>
                </div>

                <!-- Reports -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseReports">
                    <div class="sb-nav-link-icon"><i class="mdi mdi-chart-line"></i></div>
                    Reports
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseReports" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?= Html::a('Sales Report', Url::to(['report/sales']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Inventory Report', Url::to(['report/inventory']), ['class'=>'nav-link']) ?>
                    </nav>
                </div>

                <!-- Settings -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
                    <div class="sb-nav-link-icon"><i class="mdi mdi-cog-outline"></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSettings" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?= Html::a('General Settings', Url::to(['settings/general']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Payment Methods', Url::to(['settings/payment']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Shipping Methods', Url::to(['settings/shipping']), ['class'=>'nav-link']) ?>
                    </nav>
                </div>

                <!-- User Management -->
                <div class="sb-sidenav-menu-heading">User Management</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                    <div class="sb-nav-link-icon"><i class="mdi mdi-account-circle-outline"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?= Html::a('All Users', Url::to(['user/index']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Add User', Url::to(['user/create']), ['class'=>'nav-link']) ?>
                        <?= Html::a('Roles & Permissions', Url::to(['user/roles']), ['class'=>'nav-link']) ?>
                    </nav>
                </div>

                <!-- Help -->
                <div class="sb-sidenav-menu-heading">Help</div>
                <?= Html::a('<div class="sb-nav-link-icon"><i class="mdi mdi-file-document"></i></div>Documentation', 
                    Url::to(['site/documentation']), 
                    ['class' => 'nav-link']
                ) ?>

            </div>
        </div>

        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= Yii::$app->user->identity->username ?? 'Guest' ?>
        </div>
    </nav>
</div>
