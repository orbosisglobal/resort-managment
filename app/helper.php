<?php

use Illuminate\Support\Facades\Http;
use App\Models\ShiprocketToken;
use App\Models\Settings;
use Carbon\Carbon;
use Symfony\Component\Process\Process;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeNames)
    {
        return request()->routeIs($routeNames) ? 'active' : '';
    }
}

if (!function_exists('isActiveModule')) {
    function isActiveModule($routeNames)
    {
        return request()->routeIs($routeNames) ? 'here show' : '';
    }
}

if (!function_exists('formatIndianNumber')) {
    function formatIndianNumber($number)
    {
        // Round off the number and convert it to a string
        $number = round($number);
        $number = (string)$number;

        // Extract the last three digits
        $last3digits = substr($number, -3);

        // Extract the rest of the units (everything before the last three digits)
        $restUnits = substr($number, 0, -3);
        $formattedNumber = '';

        // Format the rest of the units into the Indian number system
        if (strlen($restUnits) > 0) {
            $restUnits = (strlen($restUnits) % 2 == 1) ? "0" . $restUnits : $restUnits;
            $splitUnits = str_split($restUnits, 2);
            foreach ($splitUnits as $index => $unit) {
                if ($index == 0 && $unit[0] == "0") {
                    $unit = substr($unit, 1);
                }
                $formattedNumber .= $unit . ",";
            }
        }

        // Concatenate the formatted units and the last three digits
        $formattedNumber .= $last3digits;
        return $formattedNumber;
    }
}
if (!function_exists('addRupeeSymbol')) {
    function addRupeeSymbol($value)
    {
        return '₹ ' . $value;
    }
}
