<?php include_once __DIR__ . '/header.php'; ?>

<main style="flex: 1;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="welcome-section bg-white p-5 rounded-4 shadow-sm">
                    <h1 class="display-4 mb-4 text-primary fw-bold">خوش آمدید</h1>
                    <p class="lead mb-4 text-muted">پروژه برنامه نویسی وب</p>
                    <hr class="my-4">
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="/project/post" class="btn btn-primary btn-lg px-4 gap-3">
                            <i class="fas fa-newspaper me-2"></i>
                            مشاهده پست‌ها
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.welcome-section {
    background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
    border: 1px solid rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.welcome-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.btn-primary {
    background-color: #1f3de2;
    border-color: #1f3de2;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #e3c628;
    border-color: #e3c628;
    color: #1f3de2;
    transform: translateY(-2px);
}

.text-primary {
    color: #1f3de2 !important;
}
</style>

<?php include_once __DIR__ . '/footer.php'; ?>
