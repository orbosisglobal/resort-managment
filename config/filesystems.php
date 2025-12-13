<?php
$uploadsUrlPath = 'uploads/';  //use to get image
$uploadsStorePath = "/uploads/"; // use to store image
$uploadsStorePathApi = "storage/uploads/"; // use to show image in api
return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */
    'path' => [
        //HTTP URL Paths [Eg. get image]
        //http://localhost:8000/storage/app/public/
        'url' => [
            'logo' => $uploadsUrlPath . "logo/",
            'banner_images' => $uploadsUrlPath . "banner_images/",
            'product_images' => $uploadsUrlPath . "product_images/",
            'categories_images' => $uploadsUrlPath . "categories_images/",
            'brands_images' => $uploadsUrlPath . "brands_images/",
            'service_images' => $uploadsUrlPath . "service_images/",
            'product_images' => $uploadsUrlPath . "product_images/",
            'blog_images' => $uploadsUrlPath . "blog_images/",
            'company_settings' => $uploadsUrlPath . "company_settings/",
            'user_images' => $uploadsUrlPath . "user_images/",
            'voucher_images' => $uploadsUrlPath . "voucher_images/",
            // Add more paths if needed
        ],
        //Storage Document Paths [Eg. store image]
        // /var/www/html/projectname/storage/
        'storage' => [
            "logo" => $uploadsStorePath . "logo/",
            "banner_images" => $uploadsStorePath . "banner_images/",
            "product_images" => $uploadsStorePath . "product_images/",
            "categories_images" => $uploadsStorePath . "categories_images/",
            "brands_images" => $uploadsStorePath . "brands_images/",
            "service_images" => $uploadsStorePath . "service_images/",
            "product_images" => $uploadsStorePath . "product_images/",
            "blog_images" => $uploadsStorePath . "blog_images/",
            "company_settings" => $uploadsStorePath . "company_settings/",
            'user_images' => $uploadsStorePath . "user_images/",
            'voucher_images' => $uploadsStorePath . "voucher_images/",


            // Add more paths if needed
        ],
        'api' => [
            "logo" => $uploadsStorePathApi . "logo/",
            "banner_images" => $uploadsStorePathApi . "banner_images/",
            "product_images" => $uploadsStorePathApi . "product_images/",
            "categories_images" => $uploadsStorePathApi . "categories_images/",
            "brands_images" => $uploadsStorePathApi . "brands_images/",
            "service_images" => $uploadsStorePathApi . "service_images/",
            "product_images" => $uploadsStorePathApi . "product_images/",
            "blog_images" => $uploadsStorePathApi . "blog_images/",
            "company_settings" => $uploadsStorePathApi . "company_settings/",
            'user_images' => $uploadsStorePathApi . "user_images/",
            'voucher_images' => $uploadsStorePathApi . "voucher_images/",

            // Add more paths if needed

        ],

    ],
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
