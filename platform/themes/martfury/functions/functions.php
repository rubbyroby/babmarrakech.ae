<?php

use Botble\Ads\Facades\AdsManager;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Facades\MetaBox;
use Botble\Marketplace\Models\Store;
use Botble\Media\Facades\RvMedia;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;

register_page_template([
    'blog-sidebar' => __('Blog Sidebar'),
    'full-width' => __('Full width'),
    'homepage' => __('Homepage'),
    'coming-soon' => __('Coming soon'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => __('Footer sidebar'),
    'description' => __('Widgets in footer of page'),
]);

register_sidebar([
    'id' => 'bottom_footer_sidebar',
    'name' => __('Bottom Footer sidebar'),
    'description' => __('Widgets in bottom footer'),
]);

RvMedia::setUploadPathAndURLToPublic();

RvMedia::addSize('medium', 790, 510)->addSize('small', 300, 300);

add_action('init', function () {
    EmailHandler::addTemplateSettings(Theme::getThemeName(), [
        'name' => __('Theme emails'),
        'description' => __('Config email templates for theme'),
        'templates' => [
            'download_app' => [
                'title' => __('Download apps'),
                'description' => __('Send mail with links to download apps'),
                'subject' => __('Download apps'),
                'can_off' => true,
            ],
        ],
        'variables' => [],
    ], 'themes');
}, 125);

if (is_plugin_active('ads')) {
    AdsManager::registerLocation('top-slider-image-1', __('Top Slider Image 1 (deprecated)'))
        ->registerLocation('top-slider-image-2', __('Top Slider Image 2 (deprecated)'))
        ->registerLocation('product-sidebar', __('Product sidebar'));
}

add_action([BASE_ACTION_AFTER_CREATE_CONTENT, BASE_ACTION_AFTER_UPDATE_CONTENT], function ($type, $request, $object) {
    if (! $object instanceof Store || Route::currentRouteName() !== 'marketplace.vendor.settings.post') {
        return;
    }

    if ($request->hasFile('cover_image_input')) {
        $result = RvMedia::handleUpload($request->file('cover_image_input'), 0, 'stores');
        if (! $result['error']) {
            MetaBox::saveMetaBoxData($object, 'cover_image', $result['data']->url);
        }
    } elseif ($request->input('cover_image')) {
        MetaBox::saveMetaBoxData($object, 'cover_image', $request->input('cover_image'));
    } elseif ($request->has('cover_image') && ! $request->input('cover_image')) {
        MetaBox::deleteMetaData($object, 'cover_image');
    }
}, 145, 3);
