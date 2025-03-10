<?php $__env->startSection('header'); ?>
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
        Admin Dashboard - <?php echo e(Auth::user()->name); ?>

    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Danh sách sản phẩm</h3>
                        <form class="flex gap-2" action="<?php echo e(route('admin.product.search')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="text" class="rounded-md border-gray-300" name="search"
                                placeholder="Tìm kiếm sản phẩm">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Tìm kiếm
                            </button>
                        </form>
                    </div>

                    <div class="flex gap-4 mb-6">
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            Danh mục 1 <span class="text-gray-500">(10)</span>
                        </a>
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            Danh mục 2 <span class="text-gray-500">(5)</span>
                        </a>
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            Danh mục 3 <span class="text-gray-500">(20)</span>
                        </a>
                    </div>

                    <div class="flex gap-2 mb-6">
                        <select class="rounded-md border-gray-300">
                            <option>Chọn</option>
                            <option>Xóa sản phẩm</option>
                            <option>Cập nhật sản phẩm</option>
                        </select>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Áp dụng
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-4 w-4">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên sản phẩm
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Giá</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Danh mục
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày tạo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if(session('success')): ?>
                                    <div
                                        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                <?php endif; ?>

                                <?php if(session('error')): ?>
                                    <div
                                        class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                <?php endif; ?>

                                <?php if(!empty($products) && $products->count() > 0): ?>
                                    <?php $i = ($products->currentPage() - 1) * 10 + 1; ?>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="p-4"><input type="checkbox" class="rounded border-gray-300"></td>
                                            <td class="px-6 py-4"><?php echo e($i++); ?></td>
                                            <td class="px-6 py-3 min-w-[100px]"><?php echo e($product->name); ?></td>
                                            <td class="px-6 py-4"><?php echo e($product->slug); ?></td>
                                            <td class="px-6 py-4"><?php echo e(number_format($product->price, 0, ',', '.')); ?> đ</td>
                                            <td class="px-6 py-4"><?php echo e($product->category->name ?? 'Không có danh mục'); ?></td>
                                            <td class="px-6 py-4"><?php echo e($product->created_at->format('d/m/Y')); ?></td>
                                            <td class="px-6 py-4">
                                                <div class="flex gap-2">
                                                    <a href="#"
                                                        class="p-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                                        Sửa
                                                    </a>
                                                    <form action="#" method="POST"
                                                        onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button
                                                            class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                                            Xóa
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center p-4">Không tìm thấy sản phẩm.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 bg-white-50">
                        <nav class="flex justify-end p-4">
                            <?php echo e($products->links()); ?>

                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/AMPPS/www/laravel/ecommerce/resources/views/admin/products/list.blade.php ENDPATH**/ ?>