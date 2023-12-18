<?php


use App\Models\Setting;
use Ramsey\Uuid\Type\Integer;
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
    $lastBalnce = null;
    if ($curentRecord) {
        $lastBalnce = $customer->details()->where('id','!=',$curentRecord->id)->orderBy('id','DESC')->first();
    }

    if($lastBalnce){
        return ($lastBalnce->balance > 0) ? $lastBalnce->balance : 0;
    }
    return 0;
}


function amountPayable($amount, $customer){

    $previous = getCustomerLastBalance($customer);
    if($previous > 0){
        $payable = $amount + $previous;
        return $payable;
    }
    return $amount;
}
