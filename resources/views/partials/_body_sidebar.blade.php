@php
$url = '';

$MyNavBar = \Menu::make('MenuList', function ($menu) use($url){

$menu->add('<span>'.__('messages.main').'</span>', ['class' => 'category-main']);

$menu->add('<span>'.__('messages.dashboard').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.dashboard').'</span></span>', ['route' => 'home'])
->prepend('<svg width="14" height="14" class="sidebar-menu-icon" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 1.75V3.25H9.25V1.75H12.25ZM4.75 1.75V6.25H1.75V1.75H4.75ZM12.25 7.75V12.25H9.25V7.75H12.25ZM4.75 10.75V12.25H1.75V10.75H4.75ZM13.75 0.25H7.75V4.75H13.75V0.25ZM6.25 0.25H0.25V7.75H6.25V0.25ZM13.75 6.25H7.75V13.75H13.75V6.25ZM6.25 9.25H0.25V13.75H6.25V9.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);



$menu->add(__('messages.sidebar_form_title',['form' => trans('messages.news')]), ['class' => 'category-main'])->data('permission', 'news list');

$menu->add('<span>'.__('messages.news_lists').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.news_lists').'</span></span>', ['route' => 'news.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('booking')
->data('permission', 'news list');
$menu->add('<span>'.__('messages.news_categories').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.news_categories').'</span></span>', ['route' => 'news-categories.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('booking')
->data('permission', 'news categories list');


$menu->add(__('messages.sidebar_form_title',['form' => trans('messages.jobs')]), ['class' => 'category-main'])->data('permission', 'jobs list');

$menu->add('<span>'.__('messages.jobs_lists').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.jobs_lists').'</span></span>', ['route' => 'jobs.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('jobs')
->data('permission', 'jobs list');

$menu->add('<span>'.__('messages.jobs_categories').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.jobs_categories').'</span></span>', ['route' => 'jobs-categories.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('jobs')
->data('permission', 'jobs categories list');

$menu->add('<span>'.__('Push Notification').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('Push Notification').'</span></span>', ['route' => 'push-notification.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('jobs')
->data('permission', 'jobs list');


$menu->add('<span>'.__('Jobs Payment').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('Jobs Payment').'</span></span>', ['route' => 'jobs-payment.index'])
->prepend('<svg width="16" height="12" class="sidebar-menu-icon" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M14 0H2C1.1675 0 0.5075 0.6675 0.5075 1.5L0.5 10.5C0.5 11.3325 1.1675 12 2 12H14C14.8325 12 15.5 11.3325 15.5 10.5V1.5C15.5 0.6675 14.8325 0 14 0ZM14 10.5H2V6H14V10.5ZM14 3H2V1.5H14V3Z" fill="#6C757D" />
</svg>
')
->nickname('payment')
->data('permission', 'payment list');


$menu->add(__('messages.sidebar_form_title',['form' => trans('messages.market_place')]), ['class' => 'category-main'])->data('permission', 'order list');

$menu->add('<span>'.__('messages.orders').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.orders').'</span></span>', ['route' => 'orders.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('order')
->data('permission', 'order list');



$menu->add(__('messages.sidebar_form_title',['form' => trans('messages.service_booking')]), ['class' => 'category-main'])->data('permission', 'booking list');
$menu->add('<span>'.__('messages.shop_booking').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.shop_booking').'</span></span>', ['route' => 'shop-booking.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('booking')
->data('permission', 'booking list');

$menu->add('<span>'.__('messages.online_booking').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.online_booking').'</span></span>', ['route' => 'online-booking.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('booking')
->data('permission', 'booking list');


$menu->add('<span>'.__('messages.all_booking').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.all_booking').'</span></span>', ['route' => 'booking.index'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('booking')
->data('permission', 'booking list');

$menu->add('<span>'.__('messages.quick_booking').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.quick_booking').'</span></span>', ['route' => 'quickbooking'])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H12.25C13.075 15.5 13.75 14.825 13.75 14V3.5C13.75 2.675 13.075 2 12.25 2ZM12.25 14H1.75V6.5H12.25V14ZM12.25 5H1.75V3.5H12.25V5ZM7 8.75H10.75V12.5H7V8.75Z" fill="#6C757D" />
</svg>')
->nickname('booking')
->data('permission', 'booking list');



$menu->add(__('messages.sidebar_form_title',['form' => trans('messages.service')]), ['class' => 'category-main'])
->data('permission', ['category list','subcategory list','service list']);

$menu->add('<span>'.trans('messages.category').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.category').'</span></span>', ['class' => ''])
->prepend(' <svg width="15" height="16" class="sidebar-menu-icon" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M7 0.5L2.875 7.25H11.125L7 0.5ZM7 3.38L8.4475 5.75H5.545L7 3.38ZM11.125 8.75C9.2575 8.75 7.75 10.2575 7.75 12.125C7.75 13.9925 9.2575 15.5 11.125 15.5C12.9925 15.5 14.5 13.9925 14.5 12.125C14.5 10.2575 12.9925 8.75 11.125 8.75ZM11.125 14C10.09 14 9.25 13.16 9.25 12.125C9.25 11.09 10.09 10.25 11.125 10.25C12.16 10.25 13 11.09 13 12.125C13 13.16 12.16 14 11.125 14ZM0.25 15.125H6.25V9.125H0.25V15.125ZM1.75 10.625H4.75V13.625H1.75V10.625Z" fill="#6C757D" />
</svg>')
->nickname('category')
->data('permission', 'category list')
->link->attr(["class" => ""])
->href('#category');

$menu->category->add('<span>'.trans('messages.list_form_title',['form' => trans('messages.category')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'category.index'])
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->data('permission', 'category list')
->link->attr(['class' => '']);

$menu->category->add('<span>'.trans('messages.add_form_title',['form' => trans('messages.category')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'category.create'])
->data('permission', 'category add')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.75 4.25H7.25V7.25H4.25V8.75H7.25V11.75H8.75V8.75H11.75V7.25H8.75V4.25ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);


$menu->add('<span>'.trans('messages.subcategory').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.subcategory').'</span></span>', ['class' => ''])
->prepend('<svg width="15" height="15" class="sidebar-menu-icon" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M9.5929 14.04C9.39871 13.8445 9.24098 13.6159 9.12715 13.365H4.44115C3.90445 13.3638 3.39007 13.1501 3.01057 12.7706C2.63107 12.3911 2.41734 11.8767 2.41615 11.34V4.70025C1.9018 4.54051 1.46181 4.20156 1.17612 3.74498C0.890435 3.28841 0.778002 2.7445 0.85925 2.21208C0.940498 1.67965 1.21004 1.19404 1.6189 0.843449C2.02776 0.492863 2.54881 0.300569 3.0874 0.301502C3.6243 0.301665 4.14345 0.493813 4.55108 0.843244C4.95871 1.19267 5.22795 1.67635 5.31017 2.20692C5.3924 2.73749 5.28219 3.27997 4.99944 3.73639C4.7167 4.19282 4.28007 4.53309 3.7684 4.69575V6.159H9.03715C9.19665 5.64774 9.53387 5.21044 9.9878 4.92622C10.4417 4.64199 10.9824 4.52961 11.512 4.6094C12.0416 4.68919 12.5251 4.95588 12.8752 5.36124C13.2252 5.76659 13.4186 6.28383 13.4204 6.8194C13.4222 7.35496 13.2322 7.87348 12.8849 8.28116C12.5376 8.68884 12.0558 8.95875 11.5268 9.04207C10.9977 9.12539 10.4563 9.01661 10.0005 8.73542C9.54468 8.45423 9.20456 8.01919 9.04165 7.509H3.7684V11.3385C3.7684 11.5175 3.83951 11.6892 3.9661 11.8158C4.09269 11.9424 4.26438 12.0135 4.4434 12.0135H8.97865C9.0755 11.5211 9.33417 11.0752 9.71355 10.7467C10.0929 10.4183 10.5712 10.226 11.0724 10.2006C11.5736 10.1752 12.0689 10.3181 12.4795 10.6065C12.8902 10.8949 13.1927 11.3123 13.3388 11.7924C13.485 12.2725 13.4664 12.7876 13.2862 13.256C13.1059 13.7243 12.7742 14.1189 12.3439 14.3771C11.9136 14.6353 11.4093 14.7422 10.9113 14.6808C10.4132 14.6195 9.94995 14.3934 9.59515 14.0385L9.5929 14.04ZM10.2844 12.4493C10.2844 12.6273 10.3372 12.8013 10.4361 12.9493C10.535 13.0973 10.6755 13.2126 10.84 13.2807C11.0044 13.3489 11.1854 13.3667 11.36 13.332C11.5346 13.2972 11.6949 13.2115 11.8208 13.0856C11.9467 12.9598 12.0324 12.7994 12.0671 12.6248C12.1018 12.4503 12.084 12.2693 12.0159 12.1048C11.9478 11.9404 11.8324 11.7998 11.6844 11.7009C11.5364 11.602 11.3624 11.5493 11.1844 11.5493C10.9461 11.5493 10.7175 11.6438 10.5488 11.8121C10.3801 11.9804 10.285 12.2087 10.2844 12.447V12.4493ZM10.2844 6.82425C10.2844 7.00225 10.3372 7.17626 10.4361 7.32426C10.535 7.47227 10.6755 7.58762 10.84 7.65574C11.0044 7.72386 11.1854 7.74168 11.36 7.70696C11.5346 7.67223 11.6949 7.58651 11.8208 7.46065C11.9467 7.33478 12.0324 7.17441 12.0671 6.99983C12.1018 6.82525 12.084 6.64429 12.0159 6.47984C11.9478 6.31538 11.8324 6.17482 11.6844 6.07593C11.5364 5.97704 11.3624 5.92425 11.1844 5.92425C10.9461 5.92425 10.7175 6.01876 10.5488 6.18706C10.3801 6.35536 10.285 6.5837 10.2844 6.822V6.82425ZM2.1844 2.54925C2.1844 2.72725 2.23718 2.90126 2.33608 3.04926C2.43497 3.19727 2.57553 3.31262 2.73998 3.38074C2.90444 3.44886 3.0854 3.46669 3.25998 3.43196C3.43456 3.39723 3.59493 3.31151 3.7208 3.18565C3.84666 3.05978 3.93238 2.89942 3.96711 2.72483C4.00183 2.55025 3.98401 2.36929 3.91589 2.20484C3.84777 2.04038 3.73242 1.89982 3.58441 1.80093C3.43641 1.70204 3.2624 1.64925 3.0844 1.64925C2.84609 1.64925 2.61752 1.74376 2.4488 1.91206C2.28008 2.08036 2.185 2.3087 2.1844 2.547V2.54925Z" fill="#6C757D" />
</svg>')
->nickname('subcategory')
->data('permission', 'subcategory list')
->link->attr(["class" => ""])
->href('#subcategory');

$menu->subcategory->add('<span>'.trans('messages.list_form_title',['form' => trans('messages.subcategory')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'subcategory.index'])
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->data('permission', 'subcategory list')
->link->attr(['class' => '']);

$menu->subcategory->add('<span>'.trans('messages.add_form_title',['form' => trans('messages.subcategory')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'subcategory.create'])
->data('permission', 'subcategory add')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.75 4.25H7.25V7.25H4.25V8.75H7.25V11.75H8.75V8.75H11.75V7.25H8.75V4.25ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->add('<span>'.trans('messages.service').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.service').'</span></span>', ['class' => ''])
->prepend('<svg width="18" height="16" class="sidebar-menu-icon" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M9.16495 13.8875C9.02995 14.0225 8.78995 14.045 8.63245 13.8875C8.49745 13.7525 8.47495 13.5125 8.63245 13.355L11.1749 10.8125L10.1174 9.755L7.57495 12.2975C7.43245 12.4475 7.19245 12.44 7.04245 12.2975C6.88495 12.14 6.90745 11.9 7.04245 11.765L9.58495 9.2225L8.52745 8.165L5.98495 10.7075C5.84995 10.8425 5.60995 10.865 5.45245 10.7075C5.30995 10.565 5.30995 10.325 5.45245 10.175L7.99495 7.6325L6.92995 6.575L4.38745 9.1175C4.25245 9.2525 4.01245 9.275 3.85495 9.1175C3.71245 8.9675 3.71245 8.735 3.85495 8.585L7.13995 5.3L8.54245 6.695C9.25495 7.4075 10.4849 7.4 11.1974 6.695C11.9324 5.96 11.9324 4.775 11.1974 4.04L9.80245 2.645L10.0124 2.435C10.5974 1.85 11.5499 1.85 12.1349 2.435L15.3149 5.615C15.8999 6.2 15.8999 7.1525 15.3149 7.7375L9.16495 13.8875ZM16.3724 8.8025C17.5424 7.6325 17.5424 5.735 16.3724 4.5575L13.1924 1.3775C12.0224 0.2075 10.1249 0.2075 8.94745 1.3775L8.73745 1.5875L8.52745 1.3775C7.35745 0.2075 5.45995 0.2075 4.28245 1.3775L1.62745 4.0325C0.562447 5.0975 0.464947 6.755 1.32745 7.925L2.41495 6.8375C2.12245 6.275 2.21995 5.5625 2.69245 5.09L5.34745 2.435C5.93245 1.85 6.88495 1.85 7.46995 2.435L10.1399 5.105C10.2749 5.24 10.2974 5.48 10.1399 5.6375C9.98245 5.795 9.74245 5.7725 9.60745 5.6375L7.13995 3.1775L2.78995 7.52C2.05495 8.2475 2.05495 9.44 2.78995 10.175C3.08245 10.4675 3.45745 10.6475 3.85495 10.7C3.90745 11.09 4.07995 11.465 4.37995 11.765C4.67995 12.065 5.05495 12.2375 5.44495 12.29C5.49745 12.68 5.66995 13.055 5.96995 13.355C6.26995 13.655 6.64495 13.8275 7.03495 13.88C7.08745 14.285 7.26745 14.6525 7.55995 14.945C7.91245 15.2975 8.38495 15.4925 8.88745 15.4925C9.38995 15.4925 9.86245 15.2975 10.2149 14.945L16.3724 8.8025Z" fill="#6C757D" />
</svg>')
->nickname('services')
->data('permission', 'service list')
->link->attr(["class" => ""])
->href('#services');

$menu->services->add('<span>'.trans('messages.list_form_title',['form' => trans('messages.service')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'service.index'])
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->data('permission', 'service list')
->link->attr(['class' => '']);

$menu->services->add('<span>'.trans('messages.add_form_title',['form' => trans('messages.service')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'service.create'])
->data('permission', 'service add')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.75 4.25H7.25V7.25H4.25V8.75H7.25V11.75H8.75V8.75H11.75V7.25H8.75V4.25ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);



$menu->add(__('messages.promotion'), ['class' => 'category-main'])->data('permission', 'coupon list');

$menu->add('<span>'.__('messages.coupon').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.coupon').'</span></span>', ['class' => ''])
->prepend('<svg width="16" height="12" class="sidebar-menu-icon" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.5 4.5V1.5C15.5 0.6675 14.825 0 14 0H2C1.175 0 0.5075 0.6675 0.5075 1.5V4.5C1.3325 4.5 2 5.175 2 6C2 6.825 1.3325 7.5 0.5 7.5V10.5C0.5 11.325 1.175 12 2 12H14C14.825 12 15.5 11.325 15.5 10.5V7.5C14.675 7.5 14 6.825 14 6C14 5.175 14.675 4.5 15.5 4.5ZM14 3.405C13.1075 3.9225 12.5 4.8975 12.5 6C12.5 7.1025 13.1075 8.0775 14 8.595V10.5H2V8.595C2.8925 8.0775 3.5 7.1025 3.5 6C3.5 4.89 2.9 3.9225 2.0075 3.405L2 1.5H14V3.405ZM7.25 8.25H8.75V9.75H7.25V8.25ZM7.25 5.25H8.75V6.75H7.25V5.25ZM7.25 2.25H8.75V3.75H7.25V2.25Z" fill="#6C757D" />
</svg>')
->nickname('coupon')
->data('permission', 'coupon list')
->link->attr(["class" => ""])
->href('#coupon');

$menu->coupon->add('<span>'.__('messages.list_form_title',['form' => __('messages.coupon')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'coupon.index'])
->data('permission', 'coupon list')
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->coupon->add('<span>'.__('messages.add_form_title',['form' => __('messages.coupon')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'coupon.create'])
->data('permission', 'coupon add')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.75 4.25H7.25V7.25H4.25V8.75H7.25V11.75H8.75V8.75H11.75V7.25H8.75V4.25ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);



$menu->add(__('messages.sidebar_form_title',['form' => trans('messages.user')]), ['class' => 'category-main'])->data('permission', ['provider list','handyman list','user list']);


$menu->add('<span>'.__('messages.provider').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.provider').'</span></span>', ['class' => ''])
->prepend('<svg width="12" height="12" class="sidebar-menu-icon" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6 1.425C6.87 1.425 7.575 2.13 7.575 3C7.575 3.87 6.87 4.575 6 4.575C5.13 4.575 4.425 3.87 4.425 3C4.425 2.13 5.13 1.425 6 1.425ZM6 8.175C8.2275 8.175 10.575 9.27 10.575 9.75V10.575H1.425V9.75C1.425 9.27 3.7725 8.175 6 8.175ZM6 0C4.3425 0 3 1.3425 3 3C3 4.6575 4.3425 6 6 6C7.6575 6 9 4.6575 9 3C9 1.3425 7.6575 0 6 0ZM6 6.75C3.9975 6.75 0 7.755 0 9.75V12H12V9.75C12 7.755 8.0025 6.75 6 6.75Z" fill="#6C757D" />
</svg>')
->nickname('provider')
->data('permission', 'provider list')
->link->attr(["class" => ""])
->href('#providers');

$menu->provider->add('<span>'.__('messages.list_form_title',['form' => __('messages.provider')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'provider.index'])
->data('permission', 'provider list')
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.__('messages.pending_list_form_title',['form' => __('messages.provider')]).'</span>', ['class' => 'sidebar-layout' ,'route' => ['provider.pending','pending']])
->data('permission', 'pending provider')
->prepend('<svg width="14" height="17" class="sidebar-menu-icon" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M9.75 9C7.68 9 6 10.68 6 12.75C6 14.82 7.68 16.5 9.75 16.5C11.82 16.5 13.5 14.82 13.5 12.75C13.5 10.68 11.82 9 9.75 9ZM10.9875 14.5125L9.375 12.9V10.5H10.125V12.5925L11.5125 13.98L10.9875 14.5125ZM10.5 2.25H8.115C7.8 1.38 6.975 0.75 6 0.75C5.025 0.75 4.2 1.38 3.885 2.25H1.5C0.675 2.25 0 2.925 0 3.75V15C0 15.825 0.675 16.5 1.5 16.5H6.0825C5.64 16.0725 5.28 15.5625 5.0175 15H1.5V3.75H3V6H9V3.75H10.5V7.56C11.0325 7.635 11.535 7.7925 12 8.01V3.75C12 2.925 11.325 2.25 10.5 2.25ZM6 3.75C5.5875 3.75 5.25 3.4125 5.25 3C5.25 2.5875 5.5875 2.25 6 2.25C6.4125 2.25 6.75 2.5875 6.75 3C6.75 3.4125 6.4125 3.75 6 3.75Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.__('messages.list_form_title',['form' => __('messages.providerdocument')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'providerdocument.index'])
->data('permission', 'providerdocument list')
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3.25 11.25H8.5V12.75H3.25V11.25ZM3.25 8.25H10.75V9.75H3.25V8.25ZM3.25 5.25H10.75V6.75H3.25V5.25ZM12.25 2.25H9.115C8.8 1.38 7.975 0.75 7 0.75C6.025 0.75 5.2 1.38 4.885 2.25H1.75C1.645 2.25 1.5475 2.2575 1.45 2.28C1.1575 2.34 0.895 2.49 0.6925 2.6925C0.5575 2.8275 0.445 2.9925 0.37 3.1725C0.295 3.345 0.25 3.54 0.25 3.75V14.25C0.25 14.4525 0.295 14.655 0.37 14.835C0.445 15.015 0.5575 15.1725 0.6925 15.315C0.895 15.5175 1.1575 15.6675 1.45 15.7275C1.5475 15.7425 1.645 15.75 1.75 15.75H12.25C13.075 15.75 13.75 15.075 13.75 14.25V3.75C13.75 2.925 13.075 2.25 12.25 2.25ZM7 2.0625C7.3075 2.0625 7.5625 2.3175 7.5625 2.625C7.5625 2.9325 7.3075 3.1875 7 3.1875C6.6925 3.1875 6.4375 2.9325 6.4375 2.625C6.4375 2.3175 6.6925 2.0625 7 2.0625ZM12.25 14.25H1.75V3.75H12.25V14.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.__('messages.list_form_title',['form' => __('messages.provider_payout')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'providerpayout.index'])
->data('permission', 'payout list')
->prepend('<svg width="13" height="14" class="sidebar-menu-icon" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M5.25 7.75V4.75C5.25 4.3375 4.9125 4 4.5 4H1.5V2.5H5.25V1H3.375V0.25H1.875V1H0.75C0.3375 1 0 1.3375 0 1.75V4.75C0 5.1625 0.3375 5.5 0.75 5.5H3.75V7H0V8.5H1.875V9.25H3.375V8.5H4.5C4.9125 8.5 5.25 8.1625 5.25 7.75Z" fill="#6C757D" />
    <path d="M11.6925 7.39001L7.44746 11.6275L5.32496 9.50501L4.26746 10.57L7.44746 13.75L12.75 8.44751L11.6925 7.39001Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.__('messages.list_form_title',['form' => __('messages.providertype')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'providertype.index'])
->data('permission', 'providertype list')
->prepend('<svg width="18" height="12" class="sidebar-menu-icon" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.5024 6.84747C13.5299 7.54497 14.2499 8.48997 14.2499 9.74997V12H17.2499V9.74997C17.2499 8.11497 14.5724 7.14747 12.5024 6.84747Z" fill="#6C757D" />
    <path d="M11.2499 6C12.9074 6 14.2499 4.6575 14.2499 3C14.2499 1.3425 12.9074 0 11.2499 0C10.8974 0 10.5674 0.0749998 10.2524 0.18C10.8749 0.9525 11.2499 1.935 11.2499 3C11.2499 4.065 10.8749 5.0475 10.2524 5.82C10.5674 5.925 10.8974 6 11.2499 6Z" fill="#6C757D" />
    <path d="M6.75 6C8.4075 6 9.75 4.6575 9.75 3C9.75 1.3425 8.4075 0 6.75 0C5.0925 0 3.75 1.3425 3.75 3C3.75 4.6575 5.0925 6 6.75 6ZM6.75 1.5C7.575 1.5 8.25 2.175 8.25 3C8.25 3.825 7.575 4.5 6.75 4.5C5.925 4.5 5.25 3.825 5.25 3C5.25 2.175 5.925 1.5 6.75 1.5Z" fill="#6C757D" />
    <path d="M6.75 6.75C4.7475 6.75 0.75 7.755 0.75 9.75V12H12.75V9.75C12.75 7.755 8.7525 6.75 6.75 6.75ZM11.25 10.5H2.25V9.7575C2.4 9.2175 4.725 8.25 6.75 8.25C8.775 8.25 11.1 9.2175 11.25 9.75V10.5Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.__('messages.list_form_title',['form' => __('messages.provider_address')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'provideraddress.index'])
->data('permission', 'provideraddress list')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2348_716)">
        <path d="M8 3.21865L12 6.81865V13.0667H10.4V8.26665H5.6V13.0667H4V6.81865L8 3.21865M8 1.06665L0 8.26665H2.4V14.6667H7.2V9.86665H8.8V14.6667H13.6V8.26665H16L8 1.06665Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2348_716">
            <rect width="16" height="16" fill="white" />
        </clipPath>
    </defs>
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.__('messages.list_form_title',['form' => __('messages.wallet')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'wallet.index'])
->data('permission', 'wallet list')
->prepend('<svg width="15" height="14" class="sidebar-menu-icon" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M13.75 3.46V1.75C13.75 0.925 13.075 0.25 12.25 0.25H1.75C0.9175 0.25 0.25 0.925 0.25 1.75V12.25C0.25 13.075 0.9175 13.75 1.75 13.75H12.25C13.075 13.75 13.75 13.075 13.75 12.25V10.54C14.1925 10.2775 14.5 9.805 14.5 9.25V4.75C14.5 4.195 14.1925 3.7225 13.75 3.46ZM13 4.75V9.25H7.75V4.75H13ZM1.75 12.25V1.75H12.25V3.25H7.75C6.925 3.25 6.25 3.925 6.25 4.75V9.25C6.25 10.075 6.925 10.75 7.75 10.75H12.25V12.25H1.75Z" fill="#6C757D" />
    <path d="M10 8.125C10.6213 8.125 11.125 7.62132 11.125 7C11.125 6.37868 10.6213 5.875 10 5.875C9.37868 5.875 8.875 6.37868 8.875 7C8.875 7.62132 9.37868 8.125 10 8.125Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.__('messages.list_form_title',['form' => __('messages.subscribe')]).'</span>', ['class' => 'sidebar-layout' ,'route' => ['provider.pending','subscribe']])
->data('role', 'admin')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 3.5H14V5H2V3.5ZM3.5 0.5H12.5V2H3.5V0.5ZM14 6.5H2C1.175 6.5 0.5 7.175 0.5 8V14C0.5 14.825 1.175 15.5 2 15.5H14C14.825 15.5 15.5 14.825 15.5 14V8C15.5 7.175 14.825 6.5 14 6.5ZM14 14H2V8H14V14ZM6.5 8.5475V13.445L11 11L6.5 8.5475Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.trans('messages.list_form_title',['form' => trans('messages.bank')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'bank.index'])
->prepend('<svg width="15" height="16" class="sidebar-menu-icon" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3.875 7.5H2.375V12.75H3.875V7.5ZM8.375 7.5H6.875V12.75H8.375V7.5ZM14.75 14.25H0.5V15.75H14.75V14.25ZM12.875 7.5H11.375V12.75H12.875V7.5ZM7.625 2.445L11.5325 4.5H3.7175L7.625 2.445ZM7.625 0.75L0.5 4.5V6H14.75V4.5L7.625 0.75Z" fill="#6C757D" />
</svg>')
->data('permission', 'bank list')
->link->attr(['class' => '']);

$menu->provider->add('<span>'.trans('messages.list_form_title',['form' => trans('Provider Leads')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'providerleads.index'])
->prepend('<svg width="15" height="16" class="sidebar-menu-icon" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3.875 7.5H2.375V12.75H3.875V7.5ZM8.375 7.5H6.875V12.75H8.375V7.5ZM14.75 14.25H0.5V15.75H14.75V14.25ZM12.875 7.5H11.375V12.75H12.875V7.5ZM7.625 2.445L11.5325 4.5H3.7175L7.625 2.445ZM7.625 0.75L0.5 4.5V6H14.75V4.5L7.625 0.75Z" fill="#6C757D" />
</svg>')
->data('permission', 'bank list')
->link->attr(['class' => '']);

$menu->add('<span>'.__('messages.handyman').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.handyman').'</span></span>', ['class' => ''])
->prepend('<svg width="18" height="12" class="sidebar-menu-icon" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M16.5 3.75V2.25H15V3.75H13.5V5.25H15V6.75H16.5V5.25H18V3.75H16.5Z" fill="#6C757D" />
    <path d="M6 6C7.6575 6 9 4.6575 9 3C9 1.3425 7.6575 0 6 0C4.3425 0 3 1.3425 3 3C3 4.6575 4.3425 6 6 6ZM6 1.5C6.825 1.5 7.5 2.175 7.5 3C7.5 3.825 6.825 4.5 6 4.5C5.175 4.5 4.5 3.825 4.5 3C4.5 2.175 5.175 1.5 6 1.5Z" fill="#6C757D" />
    <path d="M6 6.75C3.9975 6.75 0 7.755 0 9.75V12H12V9.75C12 7.755 8.0025 6.75 6 6.75ZM10.5 10.5H1.5V9.7575C1.65 9.2175 3.975 8.25 6 8.25C8.025 8.25 10.35 9.2175 10.5 9.75V10.5Z" fill="#6C757D" />
    <path d="M9.38245 0.0374985C10.0724 0.832498 10.4999 1.8675 10.4999 3C10.4999 4.1325 10.0724 5.1675 9.38245 5.9625C10.8524 5.775 11.9999 4.53 11.9999 3C11.9999 1.47 10.8524 0.224998 9.38245 0.0374985Z" fill="#6C757D" />
    <path d="M12.3975 7.3725C13.065 7.995 13.5 8.775 13.5 9.75V12H15V9.75C15 8.6625 13.8075 7.8675 12.3975 7.3725Z" fill="#6C757D" />
</svg>')
->nickname('handyman')
->data('permission', 'handyman list')
->link->attr(["class" => ""])
->href('#handyman');

$menu->handyman->add('<span>'.__('messages.list_form_title',['form' => __('messages.handyman')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'handyman.index'])
->data('permission', 'handyman list')
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->handyman->add('<span>'.__('messages.pending_list_form_title',['form' => __('messages.handyman')]).'</span>', ['class' => 'sidebar-layout' ,'route' => ['handyman.pending','pending']])
->data('permission', 'pending handyman')
->prepend('<svg width="18" height="18" class="sidebar-menu-icon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2357_772)">
        <path d="M12.75 9C10.68 9 9 10.68 9 12.75C9 14.82 10.68 16.5 12.75 16.5C14.82 16.5 16.5 14.82 16.5 12.75C16.5 10.68 14.82 9 12.75 9ZM13.9875 14.5125L12.375 12.9V10.5H13.125V12.5925L14.5125 13.98L13.9875 14.5125ZM13.5 2.25H11.115C10.8 1.38 9.975 0.75 9 0.75C8.025 0.75 7.2 1.38 6.885 2.25H4.5C3.675 2.25 3 2.925 3 3.75V15C3 15.825 3.675 16.5 4.5 16.5H9.0825C8.64 16.0725 8.28 15.5625 8.0175 15H4.5V3.75H6V6H12V3.75H13.5V7.56C14.0325 7.635 14.535 7.7925 15 8.01V3.75C15 2.925 14.325 2.25 13.5 2.25ZM9 3.75C8.5875 3.75 8.25 3.4125 8.25 3C8.25 2.5875 8.5875 2.25 9 2.25C9.4125 2.25 9.75 2.5875 9.75 3C9.75 3.4125 9.4125 3.75 9 3.75Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2357_772">
            <rect width="18" height="18" fill="white" />
        </clipPath>
    </defs>
</svg>')
->link->attr(['class' => '']);

$menu->handyman->add('<span>'.__('messages.list_form_title',['form' => __('messages.handyman_earning')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'handymanEarning'])
->data('permission', 'handyman earning')
->prepend('<svg width="18" height="18" class="sidebar-menu-icon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2357_751)">
        <path d="M8.84999 8.175C7.14749 7.7325 6.59999 7.275 6.59999 6.5625C6.59999 5.745 7.35749 5.175 8.62499 5.175C9.95999 5.175 10.455 5.8125 10.5 6.75H12.1575C12.105 5.46 11.3175 4.275 9.74999 3.8925V2.25H7.49999V3.87C6.04499 4.185 4.87499 5.13 4.87499 6.5775C4.87499 8.31 6.30749 9.1725 8.39999 9.675C10.275 10.125 10.65 10.785 10.65 11.4825C10.65 12 10.2825 12.825 8.62499 12.825C7.07999 12.825 6.47249 12.135 6.38999 11.25H4.73999C4.82999 12.8925 6.05999 13.815 7.49999 14.1225V15.75H9.74999V14.1375C11.2125 13.86 12.375 13.0125 12.375 11.475C12.375 9.345 10.5525 8.6175 8.84999 8.175Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2357_751">
            <rect width="18" height="18" fill="white" />
        </clipPath>
    </defs>
</svg>')
->link->attr(['class' => '']);

$menu->handyman->add('<span>'.__('messages.list_form_title',['form' => __('messages.handymantype')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'handymantype.index'])
->data('permission', 'handymantype list')
->prepend('<svg width="18" height="18" class="sidebar-menu-icon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2357_776)">
        <path d="M3 13.5V13.0125C3 12.7575 3.12 12.5175 3.3075 12.405C4.575 11.6475 6.0225 11.25 7.5 11.25C7.5225 11.25 7.5375 11.25 7.56 11.2575C7.635 10.7325 7.785 10.23 8.0025 9.7725C7.8375 9.7575 7.6725 9.75 7.5 9.75C5.685 9.75 3.99 10.2525 2.5425 11.115C1.8825 11.505 1.5 12.24 1.5 13.0125V15H8.445C8.13 14.55 7.8825 14.04 7.7175 13.5H3Z" fill="#6C757D" />
        <path d="M7.5 9C9.1575 9 10.5 7.6575 10.5 6C10.5 4.3425 9.1575 3 7.5 3C5.8425 3 4.5 4.3425 4.5 6C4.5 7.6575 5.8425 9 7.5 9ZM7.5 4.5C8.325 4.5 9 5.175 9 6C9 6.825 8.325 7.5 7.5 7.5C6.675 7.5 6 6.825 6 6C6 5.175 6.675 4.5 7.5 4.5Z" fill="#6C757D" />
        <path d="M15.5624 12C15.5624 11.835 15.5399 11.685 15.5174 11.5275L16.3724 10.77L15.6224 9.4725L14.5349 9.84C14.2949 9.6375 14.0249 9.48 13.7249 9.3675L13.4999 8.25H11.9999L11.7749 9.3675C11.4749 9.48 11.2049 9.6375 10.9649 9.84L9.87744 9.4725L9.12744 10.77L9.98244 11.5275C9.95994 11.685 9.93744 11.835 9.93744 12C9.93744 12.165 9.95994 12.315 9.98244 12.4725L9.12744 13.23L9.87744 14.5275L10.9649 14.16C11.2049 14.3625 11.4749 14.52 11.7749 14.6325L11.9999 15.75H13.4999L13.7249 14.6325C14.0249 14.52 14.2949 14.3625 14.5349 14.16L15.6224 14.5275L16.3724 13.23L15.5174 12.4725C15.5399 12.315 15.5624 12.165 15.5624 12ZM12.7499 13.5C11.9249 13.5 11.2499 12.825 11.2499 12C11.2499 11.175 11.9249 10.5 12.7499 10.5C13.5749 10.5 14.2499 11.175 14.2499 12C14.2499 12.825 13.5749 13.5 12.7499 13.5Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2357_776">
            <rect width="18" height="18" fill="white" />
        </clipPath>
    </defs>
</svg>')
->link->attr(['class' => '']);

$menu->handyman->add('<span>'.__('messages.list_form_title',['form' => __('messages.handyman_payout')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'handymanpayout.index'])
->data('permission', 'handymanpayout list')
->prepend('<svg width="18" height="18" class="sidebar-menu-icon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2357_765)">
        <path d="M8.25 9.75V6.75C8.25 6.3375 7.9125 6 7.5 6H4.5V4.5H8.25V3H6.375V2.25H4.875V3H3.75C3.3375 3 3 3.3375 3 3.75V6.75C3 7.1625 3.3375 7.5 3.75 7.5H6.75V9H3V10.5H4.875V11.25H6.375V10.5H7.5C7.9125 10.5 8.25 10.1625 8.25 9.75Z" fill="#6C757D" />
        <path d="M14.6925 9.39001L10.4475 13.6275L8.32496 11.505L7.26746 12.57L10.4475 15.75L15.75 10.4475L14.6925 9.39001Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2357_765">
            <rect width="18" height="18" fill="white" />
        </clipPath>
    </defs>
</svg>')
->link->attr(['class' => '']);

$menu->add('<span>'.__('messages.users').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.users').'</span></span>', ['route' => 'user.index'])
->prepend('<svg width="16" height="12" class="sidebar-menu-icon" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M5.75 7.3125C3.995 7.3125 0.5 8.19 0.5 9.9375V11.25H11V9.9375C11 8.19 7.505 7.3125 5.75 7.3125ZM2.255 9.75C2.885 9.315 4.4075 8.8125 5.75 8.8125C7.0925 8.8125 8.615 9.315 9.245 9.75H2.255ZM5.75 6C7.1975 6 8.375 4.8225 8.375 3.375C8.375 1.9275 7.1975 0.75 5.75 0.75C4.3025 0.75 3.125 1.9275 3.125 3.375C3.125 4.8225 4.3025 6 5.75 6ZM5.75 2.25C6.3725 2.25 6.875 2.7525 6.875 3.375C6.875 3.9975 6.3725 4.5 5.75 4.5C5.1275 4.5 4.625 3.9975 4.625 3.375C4.625 2.7525 5.1275 2.25 5.75 2.25ZM11.03 7.3575C11.9 7.9875 12.5 8.8275 12.5 9.9375V11.25H15.5V9.9375C15.5 8.4225 12.875 7.56 11.03 7.3575ZM10.25 6C11.6975 6 12.875 4.8225 12.875 3.375C12.875 1.9275 11.6975 0.75 10.25 0.75C9.845 0.75 9.47 0.8475 9.125 1.0125C9.5975 1.68 9.875 2.4975 9.875 3.375C9.875 4.2525 9.5975 5.07 9.125 5.7375C9.47 5.9025 9.845 6 10.25 6Z" fill="#6C757D" />
</svg>')
->nickname('user')
->data('permission', 'user list');




$menu->add('Transactions', ['class' => 'category-main'])->data('permission', ['tax list','payment list','earning list']);

$menu->add('<span>'.__('messages.tax').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.tax').'</span></span>', ['route' => 'tax.index'])
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M5.17194 7.17188C5.5675 7.17188 5.95418 7.05458 6.28308 6.83482C6.61198 6.61505 6.86832 6.3027 7.0197 5.93724C7.17107 5.57179 7.21068 5.16966 7.13351 4.7817C7.05634 4.39373 6.86586 4.03737 6.58615 3.75766C6.30645 3.47796 5.95008 3.28748 5.56212 3.21031C5.17416 3.13314 4.77202 3.17274 4.40657 3.32412C4.04112 3.47549 3.72876 3.73184 3.509 4.06074C3.28924 4.38963 3.17194 4.77631 3.17194 5.17188C3.17252 5.70213 3.38342 6.2105 3.75836 6.58545C4.13331 6.9604 4.64168 7.1713 5.17194 7.17188V7.17188ZM5.17194 4.50521C5.30379 4.50521 5.43269 4.54431 5.54232 4.61756C5.65195 4.69082 5.7374 4.79494 5.78786 4.91675C5.83832 5.03857 5.85152 5.17262 5.82579 5.30194C5.80007 5.43126 5.73658 5.55005 5.64334 5.64328C5.55011 5.73652 5.43132 5.80001 5.302 5.82573C5.17268 5.85146 5.03863 5.83825 4.91682 5.7878C4.795 5.73734 4.69088 5.65189 4.61762 5.54226C4.54437 5.43262 4.50527 5.30373 4.50527 5.17188C4.50539 4.9951 4.57567 4.8256 4.70066 4.7006C4.82566 4.5756 4.99516 4.50533 5.17194 4.50521V4.50521ZM10.8282 8.82813C10.4326 8.82813 10.0459 8.94543 9.71705 9.16519C9.38815 9.38495 9.13181 9.69731 8.98043 10.0628C8.82906 10.4282 8.78945 10.8303 8.86662 11.2183C8.94379 11.6063 9.13427 11.9626 9.41398 12.2423C9.69368 12.522 10.05 12.7125 10.438 12.7897C10.826 12.8669 11.2281 12.8273 11.5936 12.6759C11.959 12.5245 12.2714 12.2682 12.4911 11.9393C12.7109 11.6104 12.8282 11.2237 12.8282 10.8281C12.8276 10.2979 12.6167 9.7895 12.2418 9.41456C11.8668 9.03961 11.3584 8.82871 10.8282 8.82813V8.82813ZM10.8282 11.4948C10.6963 11.4948 10.5674 11.4557 10.4578 11.3824C10.3482 11.3092 10.2627 11.2051 10.2123 11.0833C10.1618 10.9614 10.1486 10.8274 10.1743 10.6981C10.2001 10.5687 10.2636 10.45 10.3568 10.3567C10.45 10.2635 10.5688 10.2 10.6981 10.1743C10.8275 10.1485 10.9615 10.1618 11.0833 10.2122C11.2051 10.2627 11.3093 10.3481 11.3825 10.4577C11.4558 10.5674 11.4949 10.6963 11.4949 10.8281C11.4947 11.0049 11.4245 11.1744 11.2995 11.2994C11.1745 11.4244 11.005 11.4947 10.8282 11.4948V11.4948ZM13.1381 2.862C13.0762 2.80008 13.0027 2.75096 12.9218 2.71745C12.8409 2.68394 12.7543 2.66669 12.6667 2.66669C12.5792 2.66669 12.4925 2.68394 12.4116 2.71745C12.3307 2.75096 12.2572 2.80008 12.1954 2.862L2.86202 12.1953C2.79949 12.2571 2.74978 12.3306 2.71577 12.4117C2.68175 12.4927 2.6641 12.5797 2.66382 12.6676C2.66355 12.7554 2.68066 12.8425 2.71416 12.9238C2.74767 13.005 2.79692 13.0789 2.85907 13.141C2.92122 13.2031 2.99505 13.2524 3.0763 13.2859C3.15755 13.3194 3.24463 13.3365 3.33252 13.3362C3.42041 13.3359 3.50738 13.3183 3.58842 13.2843C3.66946 13.2503 3.74298 13.2005 3.80473 13.138L13.1381 3.80467C13.2 3.74278 13.2491 3.6693 13.2826 3.58843C13.3161 3.50756 13.3334 3.42088 13.3334 3.33334C13.3334 3.2458 13.3161 3.15911 13.2826 3.07824C13.2491 2.99737 13.2 2.92389 13.1381 2.862V2.862Z" fill="#6C757D" />
</svg>')
->nickname('tax')
->data('permission', 'tax list');


$menu->add('<span>'.__('messages.payment').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.payment').'</span></span>', ['route' => 'payment.index'])
->prepend('<svg width="16" height="12" class="sidebar-menu-icon" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M14 0H2C1.1675 0 0.5075 0.6675 0.5075 1.5L0.5 10.5C0.5 11.3325 1.1675 12 2 12H14C14.8325 12 15.5 11.3325 15.5 10.5V1.5C15.5 0.6675 14.8325 0 14 0ZM14 10.5H2V6H14V10.5ZM14 3H2V1.5H14V3Z" fill="#6C757D" />
</svg>
')
->nickname('payment')
->data('permission', 'payment list');

$menu->add('<span>'.__('messages.earning').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.earning').'</span></span>', ['route' => 'earning'])
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14ZM8.6675 7.325C7.3325 6.8825 6.6875 6.605 6.6875 5.9C6.6875 5.135 7.52 4.8575 8.045 4.8575C9.0275 4.8575 9.3875 5.6 9.47 5.8625L10.655 5.36C10.5425 5.03 10.04 3.9275 8.66 3.6875V2.75H7.3475V3.695C5.3975 4.115 5.3825 5.8325 5.3825 5.915C5.3825 7.6175 7.07 8.0975 7.895 8.3975C9.08 8.8175 9.605 9.2 9.605 9.92C9.605 10.7675 8.8175 11.1275 8.12 11.1275C6.755 11.1275 6.365 9.725 6.32 9.56L5.075 10.0625C5.5475 11.705 6.785 12.1475 7.34 12.2825V13.25H8.6525V12.32C9.0425 12.2525 10.9175 11.8775 10.9175 9.905C10.925 8.8625 10.4675 7.9475 8.6675 7.325Z" fill="#6C757D" />
</svg>')
->nickname('earning')
->data('permission', 'earning list');


$menu->add(__('messages.sidebar_form_title',['form' => trans('messages.system')]), ['class' => 'category-main'])
->data('permission', ['terms condition','privacy policy','help support','refund cancellation policy','document list']);

$menu->add('<span>'.__('messages.plan').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.plan').'</span></span>', ['route' => 'plans.index'])
->prepend('<svg width="15" height="15" class="sidebar-menu-icon" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2412_1261)">
        <path d="M8.85625 3.125L11.875 6.14375V11.875H3.125V3.125H8.85625ZM8.85625 1.875H3.125C2.4375 1.875 1.875 2.4375 1.875 3.125V11.875C1.875 12.5625 2.4375 13.125 3.125 13.125H11.875C12.5625 13.125 13.125 12.5625 13.125 11.875V6.14375C13.125 5.8125 12.9937 5.49375 12.7562 5.2625L9.7375 2.24375C9.50625 2.00625 9.1875 1.875 8.85625 1.875ZM4.375 9.375H10.625V10.625H4.375V9.375ZM4.375 6.875H10.625V8.125H4.375V6.875ZM4.375 4.375H8.75V5.625H4.375V4.375Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2412_1261">
            <rect width="15" height="15" fill="white" />
        </clipPath>
    </defs>
</svg>')
->nickname('plan')
->data('permission', 'plan list');
$menu->add('<span>'.__('Jobs Plans').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('Jobs Plans').'</span></span>', ['route' => 'jobs-plans.index'])
->prepend('<svg width="15" height="15" class="sidebar-menu-icon" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2412_1261)">
        <path d="M8.85625 3.125L11.875 6.14375V11.875H3.125V3.125H8.85625ZM8.85625 1.875H3.125C2.4375 1.875 1.875 2.4375 1.875 3.125V11.875C1.875 12.5625 2.4375 13.125 3.125 13.125H11.875C12.5625 13.125 13.125 12.5625 13.125 11.875V6.14375C13.125 5.8125 12.9937 5.49375 12.7562 5.2625L9.7375 2.24375C9.50625 2.00625 9.1875 1.875 8.85625 1.875ZM4.375 9.375H10.625V10.625H4.375V9.375ZM4.375 6.875H10.625V8.125H4.375V6.875ZM4.375 4.375H8.75V5.625H4.375V4.375Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2412_1261">
            <rect width="15" height="15" fill="white" />
        </clipPath>
    </defs>
</svg>')
->nickname('plan')
->data('permission', 'plan list');

$menu->add('<span>'.__('messages.pages').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.pages').'</span></span>', ['class' => ''])
->prepend('<svg width="15" height="15" class="sidebar-menu-icon" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_2412_1231)">
        <path d="M5 10H10V11.25H5V10ZM5 7.5H10V8.75H5V7.5ZM8.75 1.25H3.75C3.0625 1.25 2.5 1.8125 2.5 2.5V12.5C2.5 13.1875 3.05625 13.75 3.74375 13.75H11.25C11.9375 13.75 12.5 13.1875 12.5 12.5V5L8.75 1.25ZM11.25 12.5H3.75V2.5H8.125V5.625H11.25V12.5Z" fill="#6C757D" />
    </g>
    <defs>
        <clipPath id="clip0_2412_1231">
            <rect width="15" height="15" fill="white" />
        </clipPath>
    </defs>
</svg>')
->nickname('pages')
->data('permission', 'pages')
->link->attr(["class" => ""])
->href('#pages');

$menu->pages->add('<span>'.__('messages.terms_condition').'</span>', ['class' => 'sidebar-layout' ,'route' => 'term-condition'])
->data('permission', 'terms condition')
->prepend('<svg width="16" height="12" class="sidebar-menu-icon" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M14 1.5H8L6.5 0H2C1.175 0 0.5075 0.675 0.5075 1.5L0.5 10.5C0.5 11.325 1.175 12 2 12H14C14.825 12 15.5 11.325 15.5 10.5V3C15.5 2.175 14.825 1.5 14 1.5ZM14 10.5H2V1.5H5.8775L7.3775 3H14V10.5ZM12.5 6H3.5V4.5H12.5V6ZM9.5 9H3.5V7.5H9.5V9Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->pages->add('<span>'.__('messages.privacy_policy').'</span>', ['class' => 'sidebar-layout' ,'route' => 'privacy-policy'])
->data('permission', 'privacy policy')
->prepend('<svg width="14" height="18" class="sidebar-menu-icon" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M7 0.75L0.25 3.75V8.25C0.25 12.4125 3.13 16.305 7 17.25C10.87 16.305 13.75 12.4125 13.75 8.25V3.75L7 0.75ZM12.25 8.25C12.25 11.64 10.015 14.7675 7 15.6975C3.985 14.7675 1.75 11.64 1.75 8.25V4.725L7 2.3925L12.25 4.725V8.25ZM3.5575 8.6925L2.5 9.75L5.5 12.75L11.5 6.75L10.4425 5.685L5.5 10.6275L3.5575 8.6925Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->pages->add('<span>'.__('messages.help_support').'</span>', ['class' => 'sidebar-layout' ,'route' => 'help-support'])
->data('permission', 'help support')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 3.5H0.5V14C0.5 14.825 1.175 15.5 2 15.5H12.5V14H2V3.5ZM14 0.5H5C4.175 0.5 3.5 1.175 3.5 2V11C3.5 11.825 4.175 12.5 5 12.5H14C14.825 12.5 15.5 11.825 15.5 11V2C15.5 1.175 14.825 0.5 14 0.5ZM14 11H5V2H14V11ZM9.1325 6.62C9.44 6.0725 10.0175 5.75 10.355 5.27C10.715 4.76 10.5125 3.815 9.5 3.815C8.84 3.815 8.51 4.3175 8.375 4.7375L7.3475 4.31C7.6325 3.47 8.39 2.75 9.4925 2.75C10.415 2.75 11.0525 3.17 11.375 3.695C11.6525 4.145 11.81 4.9925 11.3825 5.6225C10.91 6.32 10.46 6.53 10.2125 6.98C10.115 7.16 10.0775 7.28 10.0775 7.865H8.9375C8.945 7.5575 8.8925 7.055 9.1325 6.62ZM8.7125 9.4625C8.7125 9.02 9.065 8.6825 9.5 8.6825C9.9425 8.6825 10.28 9.02 10.28 9.4625C10.28 9.8975 9.95 10.25 9.5 10.25C9.065 10.25 8.7125 9.8975 8.7125 9.4625Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->pages->add('<span>'.__('messages.refund_cancellation_policy').'</span>', ['class' => 'sidebar-layout' ,'route' => 'refund-cancellation-policy'])
->data('permission', 'refund cancellation policy')
->prepend('<svg width="15" height="16" class="sidebar-menu-icon" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.4075 14H1.75V6.5H12.25V9.785L13.75 8.285V3.5C13.75 2.675 13.075 2 12.25 2H11.5V0.5H10V2H4V0.5H2.5V2H1.75C0.9175 2 0.2575 2.675 0.2575 3.5L0.25 14C0.25 14.825 0.9175 15.5 1.75 15.5H7.9075L6.4075 14ZM1.75 3.5H12.25V5H1.75V3.5ZM10.405 15.875L7.75 13.22L8.8075 12.1625L10.3975 13.7525L13.5775 10.5725L14.635 11.63L10.405 15.875ZM5.8075 9.5L7 10.6925L5.9425 11.75L4.75 10.5575L3.5575 11.75L2.5 10.6925L3.6925 9.5L2.5 8.3075L3.5575 7.25L4.75 8.4425L5.9425 7.25L7 8.3075L5.8075 9.5Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);


$menu->add('<span>'.__('messages.document').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.document').'</span></span>', ['class' => ''])
->prepend('<svg width="18" height="18" class="sidebar-menu-icon" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M14.25 3.75V14.25H3.75V3.75H14.25ZM14.25 2.25H3.75C2.925 2.25 2.25 2.925 2.25 3.75V14.25C2.25 15.075 2.925 15.75 3.75 15.75H14.25C15.075 15.75 15.75 15.075 15.75 14.25V3.75C15.75 2.925 15.075 2.25 14.25 2.25Z" fill="#6C757D" />
    <path d="M10.5 12.75H5.25V11.25H10.5V12.75ZM12.75 9.75H5.25V8.25H12.75V9.75ZM12.75 6.75H5.25V5.25H12.75V6.75Z" fill="#6C757D" />
</svg>')
->nickname('document')
->data('permission', 'document list')
->link->attr(["class" => ""])
->href('#document');

$menu->document->add('<span>'.__('messages.list_form_title',['form' => trans('messages.document') ]).'</span>', [ 'class' => 'sidebar-layout' , 'route' => ['document.index']])
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->data('permission', 'document list')
->link->attr(array('class' => ''));

$menu->document->add('<span>'.__('messages.add_form_title',['form' => trans('messages.document')]).'</span>', array( 'class' => 'sidebar-layout', 'route' => 'document.create'))
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.75 4.25H7.25V7.25H4.25V8.75H7.25V11.75H8.75V8.75H11.75V7.25H8.75V4.25ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14Z" fill="#6C757D" />
</svg>')
->data('permission', 'document add')
->link->attr(['class' => '']);



$menu->add('<span>'.__('messages.frontend_setting').'</span><span class="custom-tooltip"><span class="tooltip-text">frontend setting</span></span>', ['class' => ''])
->prepend('<svg width="14" height="16" class="sidebar-menu-icon" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.25 10.6275L4.6225 9L6.25 7.3725L5.1925 6.3075L2.5 9L5.1925 11.6925L6.25 10.6275Z" fill="#6C757D" />
    <path d="M8.8075 11.6925L11.5 9L8.8075 6.3075L7.75 7.3725L9.3775 9L7.75 10.6275L8.8075 11.6925Z" fill="#6C757D" />
    <path d="M12.25 2.25H9.115C8.8 1.38 7.975 0.75 7 0.75C6.025 0.75 5.2 1.38 4.885 2.25H1.75C1.645 2.25 1.5475 2.2575 1.45 2.28C1.1575 2.34 0.895 2.49 0.6925 2.6925C0.5575 2.8275 0.445 2.9925 0.37 3.1725C0.295 3.345 0.25 3.54 0.25 3.75V11.25V12V14.25C0.25 14.4525 0.295 14.655 0.37 14.835C0.445 15.015 0.5575 15.1725 0.6925 15.315C0.895 15.5175 1.1575 15.6675 1.45 15.7275C1.5475 15.7425 1.645 15.75 1.75 15.75H12.25C13.075 15.75 13.75 15.075 13.75 14.25V12V11.25V3.75C13.75 2.925 13.075 2.25 12.25 2.25ZM7 2.0625C7.3075 2.0625 7.5625 2.3175 7.5625 2.625C7.5625 2.9325 7.3075 3.1875 7 3.1875C6.6925 3.1875 6.4375 2.9325 6.4375 2.625C6.4375 2.3175 6.6925 2.0625 7 2.0625ZM12.25 11.25V12V14.25H1.75V12V11.25V3.75H12.25V11.25Z" fill="#6C757D" />
</svg>')
->nickname('frontend_setting')
->data('role', 'admin')
->link->attr(["class" => ""])
->href('#frontend_setting');

$menu->frontend_setting->add('<span>'.__('messages.list_setting_title',['form' => __('messages.app_download')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'app-download'])
->data('role', 'admin')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8 0.5C3.8675 0.5 0.5 3.8675 0.5 8C0.5 12.1325 3.8675 15.5 8 15.5C12.1325 15.5 15.5 12.1325 15.5 8C15.5 3.8675 12.1325 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14ZM9.9425 5.4425L11 6.5L8 9.5L5 6.5L6.0575 5.4425L7.25 6.6275V3.5H8.75V6.6275L9.9425 5.4425ZM11.75 11.75H4.25V10.25H11.75V11.75Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->add('<span>'.__('messages.account_setting').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.account_setting').'</span></span>', ['class' => ''])
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM4.5125 12.875C5.495 12.17 6.695 11.75 8 11.75C9.305 11.75 10.505 12.17 11.4875 12.875C10.505 13.58 9.305 14 8 14C6.695 14 5.495 13.58 4.5125 12.875ZM12.605 11.84C11.3375 10.85 9.74 10.25 8 10.25C6.26 10.25 4.6625 10.85 3.395 11.84C2.525 10.7975 2 9.4625 2 8C2 4.685 4.685 2 8 2C11.315 2 14 4.685 14 8C14 9.4625 13.475 10.7975 12.605 11.84Z" fill="#6C757D" />
    <path d="M8 3.5C6.5525 3.5 5.375 4.6775 5.375 6.125C5.375 7.5725 6.5525 8.75 8 8.75C9.4475 8.75 10.625 7.5725 10.625 6.125C10.625 4.6775 9.4475 3.5 8 3.5ZM8 7.25C7.3775 7.25 6.875 6.7475 6.875 6.125C6.875 5.5025 7.3775 5 8 5C8.6225 5 9.125 5.5025 9.125 6.125C9.125 6.7475 8.6225 7.25 8 7.25Z" fill="#6C757D" />
</svg>')
->nickname('account_setting')
->data('permission', ['role list','permission list'])
->link->attr(["class" => ""])
->href('#account_setting');

$menu->account_setting->add('<span>'.__('messages.list_form_title',['form' => __('messages.role')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'role.index'])
->data('permission', 'role list')
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->account_setting->add('<span>'.__('messages.list_form_title',['form' => __('messages.permission')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'permission.index'])
->data('permission', 'permission list')
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);


$menu->add('<span>'.__('messages.setting').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.setting').'</span></span>', ['route' => 'setting.index'])
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M13.5725 8.735C13.6025 8.495 13.625 8.255 13.625 8C13.625 7.745 13.6025 7.505 13.5725 7.265L15.155 6.0275C15.2975 5.915 15.335 5.7125 15.245 5.5475L13.745 2.9525C13.6775 2.8325 13.55 2.765 13.415 2.765C13.37 2.765 13.325 2.7725 13.2875 2.7875L11.42 3.5375C11.03 3.2375 10.61 2.99 10.1525 2.8025L9.8675 0.815C9.845 0.635 9.6875 0.5 9.5 0.5H6.5C6.3125 0.5 6.155 0.635 6.1325 0.815L5.8475 2.8025C5.39 2.99 4.97 3.245 4.58 3.5375L2.7125 2.7875C2.6675 2.7725 2.6225 2.765 2.5775 2.765C2.45 2.765 2.3225 2.8325 2.255 2.9525L0.755002 5.5475C0.657502 5.7125 0.702502 5.915 0.845002 6.0275L2.4275 7.265C2.3975 7.505 2.375 7.7525 2.375 8C2.375 8.2475 2.3975 8.495 2.4275 8.735L0.845002 9.9725C0.702502 10.085 0.665002 10.2875 0.755002 10.4525L2.255 13.0475C2.3225 13.1675 2.45 13.235 2.585 13.235C2.63 13.235 2.675 13.2275 2.7125 13.2125L4.58 12.4625C4.97 12.7625 5.39 13.01 5.8475 13.1975L6.1325 15.185C6.155 15.365 6.3125 15.5 6.5 15.5H9.5C9.6875 15.5 9.845 15.365 9.8675 15.185L10.1525 13.1975C10.61 13.01 11.03 12.755 11.42 12.4625L13.2875 13.2125C13.3325 13.2275 13.3775 13.235 13.4225 13.235C13.55 13.235 13.6775 13.1675 13.745 13.0475L15.245 10.4525C15.335 10.2875 15.2975 10.085 15.155 9.9725L13.5725 8.735ZM12.0875 7.4525C12.1175 7.685 12.125 7.8425 12.125 8C12.125 8.1575 12.11 8.3225 12.0875 8.5475L11.9825 9.395L12.65 9.92L13.46 10.55L12.935 11.4575L11.9825 11.075L11.2025 10.76L10.5275 11.27C10.205 11.51 9.8975 11.69 9.59 11.8175L8.795 12.14L8.675 12.9875L8.525 14H7.475L7.3325 12.9875L7.2125 12.14L6.4175 11.8175C6.095 11.6825 5.795 11.51 5.495 11.285L4.8125 10.76L4.0175 11.0825L3.065 11.465L2.54 10.5575L3.35 9.9275L4.0175 9.4025L3.9125 8.555C3.89 8.3225 3.875 8.15 3.875 8C3.875 7.85 3.89 7.6775 3.9125 7.4525L4.0175 6.605L3.35 6.08L2.54 5.45L3.065 4.5425L4.0175 4.925L4.7975 5.24L5.4725 4.73C5.795 4.49 6.1025 4.31 6.41 4.1825L7.205 3.86L7.325 3.0125L7.475 2H8.5175L8.66 3.0125L8.78 3.86L9.575 4.1825C9.8975 4.3175 10.1975 4.49 10.4975 4.715L11.18 5.24L11.975 4.9175L12.9275 4.535L13.4525 5.4425L12.65 6.08L11.9825 6.605L12.0875 7.4525ZM8 5C6.3425 5 5 6.3425 5 8C5 9.6575 6.3425 11 8 11C9.6575 11 11 9.6575 11 8C11 6.3425 9.6575 5 8 5ZM8 9.5C7.175 9.5 6.5 8.825 6.5 8C6.5 7.175 7.175 6.5 8 6.5C8.825 6.5 9.5 7.175 9.5 8C9.5 8.825 8.825 9.5 8 9.5Z" fill="#6C757D" />
</svg>')
->nickname('setting')
->data('permission', 'system setting');

$menu->add('<span>'.__('messages.slider').'</span><span class="custom-tooltip"><span class="tooltip-text">'.__('messages.slider').'</span></span>', ['class' => ''])
->prepend('<svg width="18" height="12" class="sidebar-menu-icon" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.75 0.75H2.25V11.25H0.75V0.75ZM3.75 0.75H5.25V11.25H3.75V0.75ZM16.5 0.75H7.5C7.0875 0.75 6.75 1.0875 6.75 1.5V10.5C6.75 10.9125 7.0875 11.25 7.5 11.25H16.5C16.9125 11.25 17.25 10.9125 17.25 10.5V1.5C17.25 1.0875 16.9125 0.75 16.5 0.75ZM15.75 9.75H8.25V2.25H15.75V9.75ZM13.0725 6.465L11.5725 8.3925L10.5 7.1025L9 8.9925H15L13.0725 6.465Z" fill="#6C757D" />
</svg>')
->nickname('sliders')
->data('permission', 'slider list')
->link->attr(["class" => ""])
->href('#sliders');

$menu->sliders->add('<span>'.__('messages.list_form_title',['form' => __('messages.slider')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'slider.index'])
->data('permission', 'slider list')
->prepend('<svg width="15" height="12" class="sidebar-menu-icon" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 4.875C1.3775 4.875 0.875 5.3775 0.875 6C0.875 6.6225 1.3775 7.125 2 7.125C2.6225 7.125 3.125 6.6225 3.125 6C3.125 5.3775 2.6225 4.875 2 4.875ZM2 0.375C1.3775 0.375 0.875 0.8775 0.875 1.5C0.875 2.1225 1.3775 2.625 2 2.625C2.6225 2.625 3.125 2.1225 3.125 1.5C3.125 0.8775 2.6225 0.375 2 0.375ZM2 9.375C1.3775 9.375 0.875 9.885 0.875 10.5C0.875 11.115 1.385 11.625 2 11.625C2.615 11.625 3.125 11.115 3.125 10.5C3.125 9.885 2.6225 9.375 2 9.375ZM4.25 11.25H14.75V9.75H4.25V11.25ZM4.25 6.75H14.75V5.25H4.25V6.75ZM4.25 0.75V2.25H14.75V0.75H4.25Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);

$menu->sliders->add('<span>'.__('messages.add_form_title',['form' => __('messages.slider')]).'</span>', ['class' => 'sidebar-layout' ,'route' => 'slider.create'])
->data('permission', 'slider add')
->prepend('<svg width="16" height="16" class="sidebar-menu-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.75 4.25H7.25V7.25H4.25V8.75H7.25V11.75H8.75V8.75H11.75V7.25H8.75V4.25ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.6925 14 2 11.3075 2 8C2 4.6925 4.6925 2 8 2C11.3075 2 14 4.6925 14 8C14 11.3075 11.3075 14 8 14Z" fill="#6C757D" />
</svg>')
->link->attr(['class' => '']);


})->filter(function ($item) {
return checkMenuRoleAndPermission($item);
});

@endphp
<div class="iq-sidebar sidebar-default">
    <div class="iq-sidebar-logo">
        <a href="{{ route('home') }}" class="header-logo">
            <img src="{{ getSingleMedia(settingSession('get'),'site_logo',null) }}" class="img-fluid rounded-normal light-logo site_logo_preview" alt="logo">
            <img src="{{ getSingleMedia(settingSession('get'),'site_logo',null) }}" class="img-fluid rounded-normal darkmode-logo site_logo_preview" alt="logo">
            <span class="white-space-no-wrap">{{ ucfirst(str_replace("_"," ",auth()->user()->user_type)) }}</span>
        </a>
        <div class="side-menu-bt-sidebar-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>
    <div class="side-menu-bt-sidebar wide-device-toggle">
        <span class="iq-toggle-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon arrow-active wrapper-menu" height="14" width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </span>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <div class="user-profile">
            <div class="avatar">
                <img class="avatar-50 rounded-circle bg-light" alt="user-icon" src="{{ asset('images/user/user.png') }}">
            </div>
            <div class="user-info">
                <h5 class="user-email">{{auth()->user()->email}}</h5>
                <span class="user-name">{{auth()->user()->display_name}}</span>
            </div>
        </div>
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="side-menu">
                @include(config('laravel-menu.views.bootstrap-items'), ['items' => $MyNavBar->roots()])
            </ul>
        </nav>
        <div class="pt-5 pb-5"></div>
    </div>
</div>