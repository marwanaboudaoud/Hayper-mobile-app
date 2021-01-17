<?php

use Carbon\Carbon;

if (!function_exists('propExistOrNull')) {
    function propExistOrNull($class, string $prop)
    {
        return ($class && property_exists($class, $prop)) ? $class->{$prop} : null;
    }
}

if (!function_exists('keyExistOrNull')) {
    function keyExistOrNull($request, $key, $value)
    {
        return $request->has($key . '.' . $value) ? $request->get($key)[$value] : null;
    }
}

if (!function_exists('methodExistOrNull')) {
    function methodExistOrNull($class, string $method)
    {
        return ($class && method_exists($class, $method)) ? $class->{$method}() : null;
    }
}

if (!function_exists('generateGuid')) {
    function generateGuid()
    {
        return sprintf(
            '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }
}

if (!function_exists('generateContractId')) {
    function generateContractId()
    {
        return sprintf(rand(0, 100) * 100 / 2 - 5);
    }
}

if (!function_exists('generatePdf')) {
    function generatePdf(string $base64)
    {
        $data = base64_decode($base64);
//        header('Content-Type: application/pdf');
        return $data;
    }
}

if (!function_exists('downloadPdf')) {
    function downloadPdf(string $base64)
    {
        $data = base64_decode($base64);
        file_put_contents(Carbon::today()->toDateTimeString() . '.pdf', $data);
    }
}

if (!function_exists('toBase64')) {
    function toBase64(string $file)
    {
        return base64_encode(file_get_contents($file));
    }
}

if (!function_exists('makeFileName')) {
    function makeFileName(string $name, string $extension)
    {
        $nameWithOutSpace = str_replace(' ', '_', $name);
        return $nameWithOutSpace . '.' . $extension;
    }
}

if (!function_exists('keyInArray')) {
    function keyInArray(array $arr, $key)
    {
        return array_key_exists($key, $arr) ? $arr[$key] : null;
    }
}

if (!function_exists('dateDMYToYMD')) {
    function dateDMYToYMD($date)
    {
        if (!$date) {
            return null;
        }

        $arrayDate = explode('-', $date);
        $arrayReversedDate = array_reverse($arrayDate);

        return implode('-', $arrayReversedDate);
    }
}

if (!function_exists('toDateString')) {
    function toDateString(?Carbon $date)
    {
        return $date ? $date->toDateString() : null;
    }
}

if (!function_exists('calculateAge')) {
    function calculateAge(?Carbon $birthDay)
    {
        return $birthDay ? Carbon::now()->diffInYears($birthDay) : 0;
    }
}
