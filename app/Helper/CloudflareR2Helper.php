<?php

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;


if (!function_exists('uploadToCloudflareR2Helper')) {
    function uploadToCloudflareR2Helper($media)
    {
        // Retrieve Cloudflare R2 configuration from environment variables
        $img_bucket_name = env('R2_BUCKET_NAME');
        $account_id = env('R2_ACCOUNT_ID');
        $access_key_id = env('R2_ACCESS_KEY');
        $access_key_secret = env('R2_SECRET_ACCESS_KEY');

        $credentials = new Credentials($access_key_id, $access_key_secret);
        $options = [
            'region' => 'auto',
            'endpoint' => "https://$account_id.r2.cloudflarestorage.com",
            'version' => 'latest',
            'credentials' => $credentials,
            'http' => [
                'verify' => false
            ]
        ];
        $s3_client = new S3Client($options);


        try {

            $fileName = $media->file_name;


            // Upload the file to Cloudflare R2
            $result = $s3_client->putObject([
                'Bucket' => $img_bucket_name,
                'Key' =>  $media->id . '/' . $fileName,
                'SourceFile' => $media->getPath(),
                'ContentType' => $media->mime_type,
            ]);

            if ($result['@metadata']['statusCode'] === 200) {

                return true;
            } else {
                // Failed to upload file
                var_dump("sucess2");
                exit();
                return false;
            }
        } catch (Exception $e) {

            var_dump($e);
            exit();
            // An error occurred while uploading the file
            return false;
        }
    }
}

function generateUniqueFilename($file)
{
    $extension = $file->getClientOriginalExtension();
    $filename = md5(uniqid()) . '.' . $file->getClientOriginalName();

    return $filename;
}

function resizeImage($file)
{
    $img = Image::make($file->getPathname());
    $img->resize(300, 215);

    // Convert the image to WebP format and return the encoded content
    $webpImage = $img->encode('webp', 90)->getEncoded();

    return $webpImage;
}

function uploadToCloudflareR2Helper123($fileContents, $fileName)
{
    // Retrieve Cloudflare R2 configuration from environment variables
    $img_bucket_name = env('R2_BUCKET_NAME');
    $account_id = env('R2_ACCOUNT_ID');
    $access_key_id = env('R2_ACCESS_KEY');
    $access_key_secret = env('R2_SECRET_ACCESS_KEY');

    $credentials = new Credentials($access_key_id, $access_key_secret);
    $options = [
        'region' => 'auto',
        'endpoint' => "https://$account_id.r2.cloudflarestorage.com",
        'version' => 'latest',
        'credentials' => $credentials,
        'http' => [
            'verify' => false
        ]
    ];
    $s3_client = new S3Client($options);

    try {
        // Upload the file to Cloudflare R2
        $result = $s3_client->putObject([
            'Bucket' => $img_bucket_name,
            'Key' => $fileName,
            'Body' => $fileContents,
            'ContentType' => 'image/webp',
        ]);

        if ($result['@metadata']['statusCode'] === 200) {
            return true;
        } else {
            // Failed to upload file
            return false;
        }
    } catch (Exception $e) {
        // An error occurred while uploading the file
        return false;
    }
}
