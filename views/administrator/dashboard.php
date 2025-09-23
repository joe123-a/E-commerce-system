<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Admin Dashboard';
?>

<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<!-- Stats Cards Row -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Total Products</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('View Products', Url::to(['products/index']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Total Orders</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('View Orders', Url::to(['order/index']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Total Customers</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('View Customers', Url::to(['customer/index']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Revenue</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('View Reports', Url::to(['report/sales']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Sales Overview
            </div>
            <div class="card-body">
                <canvas id="salesAreaChart" width="100%" height="40"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Top Selling Products
            </div>
            <div class="card-body">
                <canvas id="topProductsChart" width="100%" height="40"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links Row -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">Add New Product</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('Add Product', Url::to(['products/create']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-plus"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">Pending Orders</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('View Pending', Url::to(['order/pending']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-clock"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body">New Customers</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('View Customers', Url::to(['customer/index']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">System Alerts</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <?= Html::a('View Alerts', Url::to(['settings/general']), ['class'=>'small text-white stretched-link']) ?>
                <div class="small text-white"><i class="fas fa-bell"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Recent Orders
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>#1001</td>
                    <td>John Doe</td>
                    <td>Pending</td>
                    <td>$120.00</td>
                    <td>2025-09-18</td>
                    <td>
                        <?= Html::a('View', Url::to(['order/view','id'=>1001]), ['class'=>'btn btn-sm btn-info']) ?>
                        <?= Html::a('Edit', Url::to(['order/update','id'=>1001]), ['class'=>'btn btn-sm btn-primary']) ?>
                        <?= Html::a('Delete', Url::to(['order/delete','id'=>1001]), ['class'=>'btn btn-sm btn-danger','data-method'=>'post','data-confirm'=>'Are you sure?']) ?>
                    </td>
                </tr>
                <!-- Add more rows dynamically from DB -->
            </tbody>
        </table>
    </div>
</div>

<!-- Include your JS to render charts -->
<?php
$script = <<<JS
// Area chart
var ctx = document.getElementById('salesAreaChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'],
        datasets: [{
            label: 'Sales',
            data: [1200, 1900, 3000, 2500, 4000, 4500, 3800, 5000],
            backgroundColor: 'rgba(78, 115, 223, 0.2)',
            borderColor: 'rgba(78, 115, 223, 1)',
            borderWidth: 2
        }]
    }
});

// Top Products Bar chart
var ctx2 = document.getElementById('topProductsChart').getContext('2d');
new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Product A','Product B','Product C','Product D','Product E'],
        datasets: [{
            label: 'Units Sold',
            data: [120, 190, 300, 250, 400],
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    }
});
JS;
$this->registerJs($script);
?>
