<?php 
if (!function_exists('asset')) {
    function asset($path)
    {
        return env('APP_URL') . $path;
    }
} 

if(!function_exists('pricing')){
    function pricing($price){
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
}

if(!function_exists('breadcrumbs')){
    function getBreadcrumbs(){
        $breadcrumbs=[];
        if(request()->is('dashboard')){
            $breadcrumbs[]=['url'=>'/dashboard','label'=>'Dashboard'];
        }else if (request()->segment(2) === 'categories') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/categories', 'label' => 'Category'];
        } else if (request()->segment(2) === 'category' && request()->segment(3) === 'create') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/categories', 'label' => 'Category'];
            $breadcrumbs[] = ['url' => '/dashboard/category/create', 'label' => 'Create'];
        }
        else if (request()->segment(2) === 'category' && request()->segment(4) === 'update') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/categories', 'label' => 'Category'];
            $breadcrumbs[] = ['url' => '/dashboard/category/{category:slug}/update', 'label' => 'Update'];
        }
        else if (request()->segment(2) === 'category' && request()->segment(4) === 'detail') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/categories', 'label' => 'Category'];
            $breadcrumbs[] = ['url' => '/dashboard/category/{category:slug}/detail', 'label' => 'Detail'];
        }
        else if (request()->segment(2) === 'products') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/products', 'label' => 'Product'];
        } else if (request()->segment(2) === 'product' && request()->segment(3) === 'create') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/products', 'label' => 'Product'];
            $breadcrumbs[] = ['url' => '/dashboard/product/create', 'label' => 'Create'];
        }
        else if (request()->segment(2) === 'product' && request()->segment(4) === 'update') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/products', 'label' => 'Product'];
            $breadcrumbs[] = ['url' => '/dashboard/product/{product:product_code}/update', 'label' => 'Update'];
        }
        else if (request()->segment(2) === 'product' && request()->segment(4) === 'detail') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/products', 'label' => 'Product'];
            $breadcrumbs[] = ['url' => '/dashboard/product/{product:product_code}/detail', 'label' => 'Detail'];
        }
        else if (request()->segment(2) === 'feedbacks') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/feedbacks', 'label' => 'Feedback'];
        }
        else if (request()->segment(2) === 'feedback' && request()->segment(4) === 'detail') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/feedbacks', 'label' => 'Feedback'];
            $breadcrumbs[] = ['url' => '/dashboard/feedback/{feedback:id}/detail', 'label' => 'Detail'];
        }
        else if (request()->segment(2) === 'customers') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/customers', 'label' => 'Customer'];
        }
        else if (request()->segment(2) === 'customer' && request()->segment(4) === 'detail') {
            $breadcrumbs[] = ['url' => '/dashboard', 'label' => 'Dashboard'];
            $breadcrumbs[] = ['url' => '/dashboard/customers', 'label' => 'Customer'];
            $breadcrumbs[] = ['url' => '/dashboard/customer/{user:id}/detail', 'label' => 'Detail'];
        }
        return $breadcrumbs;
    }
}

?>