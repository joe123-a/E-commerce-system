<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<nav class="sb-topnav navbar navbar-expand-md navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <?= Html::a('E-Commerce Admin', Url::to(['administrator/dashboard']), ['class' => 'navbar-brand ps-3']) ?>

    <!-- Sidebar Toggle (for collapsing sidebar on small screens) -->
    <button class="btn btn-link btn-sm me-2 d-md-none" id="sidebarToggle" type="button">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Toggler for right-side items -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <!-- Navbar Search -->
        <form class="d-flex ms-auto my-2 my-md-0" role="search">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search products, orders, customers..." aria-label="Search" />
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <!-- Navbar Right -->
        <ul class="navbar-nav ms-auto mt-2 mt-md-0">
            <!-- Orders Notifications -->
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle" id="ordersDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge bg-danger">3</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="ordersDropdown">
                    <li class="dropdown-header">Recent Orders</li>
                    <li><hr class="dropdown-divider"></li>
                    <li><?= Html::a('Order #1001 - Pending', Url::to(['order/view', 'id'=>1001]), ['class'=>'dropdown-item']) ?></li>
                    <li><?= Html::a('Order #1002 - Shipped', Url::to(['order/view', 'id'=>1002]), ['class'=>'dropdown-item']) ?></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><?= Html::a('View All Orders', Url::to(['order/index']), ['class'=>'dropdown-item text-center']) ?></li>
                </ul>
            </li>

            <!-- Messages Notifications -->
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle" id="messagesDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-envelope"></i>
                    <span class="badge bg-warning">5</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="messagesDropdown">
                    <li class="dropdown-header">New Messages</li>
                    <li><hr class="dropdown-divider"></li>
                    <li><?= Html::a('Customer Inquiry - John Doe', '#', ['class'=>'dropdown-item']) ?></li>
                    <li><?= Html::a('Support Ticket - Jane Smith', '#', ['class'=>'dropdown-item']) ?></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><?= Html::a('View All Messages', '#', ['class'=>'dropdown-item text-center']) ?></li>
                </ul>
            </li>

            <!-- User Profile Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i> <?= Yii::$app->user->identity->username ?? 'Admin' ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><?= Html::a('Profile', Url::to(['user/profile']), ['class' => 'dropdown-item']) ?></li>
                    <li><?= Html::a('Settings', Url::to(['settings/general']), ['class' => 'dropdown-item']) ?></li>
                    <li><?= Html::a('Activity Log', Url::to(['site/activity']), ['class' => 'dropdown-item']) ?></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <?= Html::a('Logout', Url::to(['/administrator/logout']), [
                            'class' => 'dropdown-item',
                            'data-method' => 'post'
                        ]) ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
