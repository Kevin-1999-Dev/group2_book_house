@extends('layouts.master')
@section('title')
Admin Dashboard
@endsection
@section('content')
<section>
    <div class="container text-center py-5 f-3">
        <h2 class="f-2">Hello <span class="text-danger text-uppercase">{{ Auth::user()->name }} </span> </h2>
        <p>Welcome From Admin Dashboard</p>
        <div class="mt-5 row d-flex align-items-center justify-content-between px-3 px-md-0">
            <div class="col-5 shadow bg-body rounded p-2 small-card">
                <div class="my-3 w-100">
                    <a href="{{ route('admin.category.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-list-check d-none d-md-inline-block"></i> Category</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="{{ route('admin.author.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-pen d-none d-md-inline-block"></i> Author</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="{{ route('admin.book.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-book d-none d-md-inline-block"></i> Book</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="{{ route('admin.ebook.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-book d-none d-md-inline-block"></i> EBook</button>
                    </a>
                </div>
            </div>
            <div class="col-2 pt-2 d-none d-md-inline-block">
                <img src="{{ asset('images/sign2.avif') }}" alt="" class="w-100">
            </div>
            <div class="col-5 shadow bg-body rounded p-2 small-card">
                <div class="my-3 w-100">
                    <a href="{{ route('admin.user.index') }}" class="text-decoration-none">
                        <button class="btn btn-dark w-50"><i class="fa-solid fa-users d-none d-md-inline-block"></i> User List</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="{{ route('admin.order.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-cart-shopping d-none d-md-inline-block"></i> Order List</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="{{ route('admin.payment.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-money-bill-1-wave d-none d-md-inline-block"></i> Payment</button>
                    </a>
                </div>
                <div class="my-3 w-100">
                    <a href="{{ route('admin.feedback.index') }}" class="text-decoration-none">
                        <button class="btn  btn-dark w-50"><i class="fa-solid fa-comment d-none d-md-inline-block"></i><span class=" d-none d-md-inline-block"> FeedBack List</span><span class="d-md-none">FeedBack</span></button>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-5 row">
            <h4 class="f-3 mb-2">The Latest Reports</h4>
            <div class="col-11 col-lg-5 shadow bg-body rounded mx-auto mb-3">
                <canvas id="yearlyUsers"></canvas>
            </div>
            <div class="col-2 pt-2 my-3 d-none d-lg-inline-block">
                <img src="{{ asset('images/sign4.jpg') }}" alt="" class="w-100">
            </div>
            <div class="col-11 col-lg-5 shadow bg-body rounded mx-auto">
                <canvas id="monthlyOrders"></canvas>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    // Convert PHP arrays to JavaScript arrays to show on chart
    var monthsUser = <?php echo json_encode($monthsUser); ?>;
    var countsUser = <?php echo json_encode($countsUser); ?>;
    // Create chart for yearly graph
    var ctxUser = document.getElementById('yearlyUsers').getContext('2d');
    var chartUser = new Chart(ctxUser, {
        type: 'bar',
        data: {
            labels: monthsUser,
            datasets: [{
                label: '# Yearly New Users',
                data: countsUser,
                backgroundColor: 'rgba(105, 105, 117, 0.5)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });

    // Convert PHP arrays to JavaScript arrays to show on chart
    var datesOrder = <?php echo json_encode($datesOrder); ?>;
    var countsOrder = <?php echo json_encode($countsOrder); ?>;
    // Create chart for monthly graph
    var ctxOrder = document.getElementById('monthlyOrders').getContext('2d');
    var chartOrder = new Chart(ctxOrder, {
        type: 'bar',
        data: {
            labels: datesOrder,
            datasets: [{
                label: '# Monthly Orders',
                data: countsOrder,
                backgroundColor: 'rgba(105, 105, 117, 0.5)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endsection
