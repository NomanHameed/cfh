<?php


use App\Models\Setting;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function uploadFile($file, $path, $width, $height)
{
    $extension = $file->getClientOriginalExtension();
    $name = uniqid().".".$extension;

    $folder = 'images/'.$path;
    $finalPath = $folder.'/'.$name;
    $file->move($folder, $name);
    Image::load(public_path($finalPath))->fit(Manipulations::FIT_CROP, $width, $height)->save();
    return $finalPath;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function settings($key)
{
    return Setting::get($key);
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function getAmount($item , $qty, $rate)
{
    return $qty * $rate;
}

/**
 * Get the last balance of customer.
 *
 * @return \Illuminate\Http\Response
 */
function getCustomerLastBalance($customer)
{
    $curentRecord = $customer->details()->orderBy('id','DESC')->first();
    if ($curentRecord) {
        $lastBalnce = $customer->details()->where('id','!=',$curentRecord->id)->orderBy('id','DESC')->first();
    }
    return $lastBalnce ? $lastBalnce->balance : 0;
}