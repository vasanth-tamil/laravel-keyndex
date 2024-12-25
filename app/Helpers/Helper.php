<?php

namespace App\Helpers;

use Illuminate\Support\Str;

use App\Enums\OperatingSystemEnum;

class Helper
{
    /**
     * Format paginated data for API response.
     *
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $data
     * @return array
     */
    public static function formatPagination($data): array
    {
        return [
            'data' => $data->items(),
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
        ];
    }

    /**
     * Calculate percentage value of a given price.
     *
     * @param float $price
     * @param float $percentage
     * @return float
     */
    public static function getPercentageToValue(float $price, float $percentage): float
    {
        return ($percentage / 100) * $price;
    }

    /**
     * Calculate GST value.
     *
     * @param float $price
     * @param float $gst
     * @return float
     */
    public static function calculateGST(float $price, float $gst): float
    {
        return self::getPercentageToValue($price, $gst);
    }

    /**
     * Validate email address.
     *
     * @param string $email
     * @return bool
     */
    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Calculate discount offer value.
     *
     * @param float $productPrice
     * @param float $offer
     * @param bool $isPercentage
     * @return float
     */
    public static function calculateOffer(float $productPrice, float $offer, bool $isPercentage = false): float
    {
        return $isPercentage ? self::getPercentageToValue($productPrice, $offer) : $offer;
    }

    /**
     * Format a date string into a MySQL timestamp.
     *
     * @param string $date
     * @return string
     */
    public static function formatTimestamp(string $date): string
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

    /**
     * Get the company ID for a user.
     *
     * @param object $user
     * @return int
     */
    public static function getCompanyId(object $user): int
    {
        return $user->role === 'company' ? $user->id : $user->company_id;
    }

    /**
     * Generate a unique code based on input parameters.
     *
     * @param string $name
     * @param string $paymentMethod
     * @return string
     */
    public static function generateCode(string $name, string $paymentMethod): string
    {
        $MONTHS = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
        $monthLetter = $MONTHS[intval(date('m')) - 1];
        return 'SUB@' . strtoupper(substr($paymentMethod, 0, 2)) . '-' .
            strtoupper(substr($name, 0, 2)) . date('d') . $monthLetter . date('Y') . '-' . strtoupper(Str::random(10));
    }

    /**
     * Generate and return an OTP.
     *
     * @param string $phoneNumber
     * @return string
     */
    public static function sendOtp(string $phoneNumber): string
    {
        return (string)random_int(100000, 999999);
    }

    /**
     * Upload a file to the specified directory.
     *
     * @param \Illuminate\Http\UploadedFile $requestFileObj
     * @param string $uploadDir
     * @return string
     */
    public static function uploadFile($requestFileObj, string $uploadDir): string
    {
        $fileName = Str::random(10) . '.' . $requestFileObj->getClientOriginalExtension();
        $requestFileObj->move(public_path('uploads/' . $uploadDir), $fileName);
        return $fileName;
    }

    /**
     * Get the full URL of an uploaded file.
     *
     * @param string $fileName
     * @param string $uploadDir
     * @return string
     */
    public static function getImagePath(string $fileName, string $uploadDir): string
    {
        return asset("uploads/$uploadDir/$fileName");
    }

    /**
     * Format price into a currency string.
     *
     * @param float $price
     * @return string
     */
    public static function formatPrice(float $price): string
    {
        return '₹ ' . number_format($price, 2);
    }

    /**
     * Format a timestamp into a readable date.
     *
     * @param string $timestamp
     * @return string
     */
    public static function formatDate(string $timestamp): string
    {
        return date('M d, Y', strtotime($timestamp));
    }

    /**
     * Generate an invite token for an email.
     *
     * @param string $email
     * @return string
     */
    public static function sendInvite(string $email): string
    {
        return Str::random(50);
    }

    /**
     * Generate a random string.
     *
     * @return string
     */
    public static function getOperatingSystem($userAgent): string
    {
        $patterns = [
            '/linux/i' => OperatingSystemEnum::LINUX,
            '/windows nt/i' => OperatingSystemEnum::WINDOWS,
            '/mac os|macintosh/i' => OperatingSystemEnum::MAC,
            '/android/i' => OperatingSystemEnum::ANDROID,
            '/ios|iphone|ipad/i' => OperatingSystemEnum::IOS,
        ];

        foreach ($patterns as $pattern => $os) {
            if (preg_match($pattern, $userAgent)) {
                return $os->value;
            }
        }

        return OperatingSystemEnum::UNKNOWN->value;
    }
}
