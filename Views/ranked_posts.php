<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../App/Model/RelatedPosts.php';
use App\Model\RelatedPosts;

try {
    $relatedPosts = new RelatedPosts();
    $rankedPosts = $relatedPosts->getRankedPosts();
} catch (Exception $e) {
    echo '<div style="color: white; background-color: red; padding: 10px; margin: 10px;">Error: ' . $e->getMessage() . '</div>';
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center" style="color: #1f3de2;">پست‌های رتبه‌بندی شده بر اساس اهمیت</h2>
            
            <?php if (!empty($rankedPosts)): ?>
            <div class="card" style="background-color: #1f3de2; border-color: #1f3de2;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="color: #1f3de2;">رتبه</th>
                                    <th style="color: #1f3de2;">عنوان پست</th>
                                    <th style="color: #1f3de2;">امتیاز اهمیت</th>
                                    <th style="color: #1f3de2;">تعداد بازدید</th>
                                    <th style="color: #1f3de2;">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rankedPosts as $index => $rankedPost): ?>
                                    <tr>
                                        <td style="color: #1f3de2;"><?= $index + 1 ?></td>
                                        <td style="color: #1f3de2;"><?= htmlspecialchars($rankedPost['post']['title']) ?></td>
                                        <td style="color: #1f3de2;"><?= number_format($rankedPost['importance'], 4) ?></td>
                                        <td style="color: #1f3de2;">
                                            <?= number_format($rankedPost['views']) ?>
                                        </td>
                                        <td>
                                            <a href="/project/post/show?id=<?= $rankedPost['post']['id'] ?>" 
                                               class="btn btn-sm" 
                                               style="background-color: transparent; border-color: #1f3de2; color: #1f3de2;">
                                                مشاهده
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <div class="alert alert-warning" style="background-color: #1f3de2; border-color: #1f3de2; color: #1f3de2;">
                    هیچ پستی برای نمایش وجود ندارد یا خطایی رخ داده است.
                </div>
            <?php endif; ?>

            <!-- توضیحات الگوریتم -->
            <div class="card mt-4" style="background-color: #1f3de2; border-color: #1f3de2;">
                <div class="card-body">
                    <h4 style="color: #1f3de2;">درباره الگوریتم رتبه‌بندی</h4>
                    <p style="color: #1f3de2;">
                        این الگوریتم از روش PageRank گوگل الهام گرفته شده است. در این روش:
                    </p>
                    <ul style="color: #1f3de2;">
                        <li>یک ماتریس احتمال A[i,j] ساخته می‌شود که نشان می‌دهد احتمال رفتن از پست i به پست j چقدر است.</li>
                        <li>این احتمال بر اساس تعداد بازدیدهای پست‌های مرتبط محاسبه می‌شود.</li>
                        <li>با استفاده از روش توانی (Power Iteration)، بردار ویژه اصلی این ماتریس محاسبه می‌شود.</li>
                        <li>مقادیر این بردار ویژه نشان‌دهنده اهمیت نسبی هر پست است.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> 