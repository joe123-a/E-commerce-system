<?php
namespace app\components;

class Helper
{
    public static function renderStars($rating)
    {
        $fullStars = floor($rating);
        $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;

        $stars = str_repeat('<i class="fas fa-star text-primary"></i>', $fullStars);
        $stars .= $halfStar ? '<i class="fas fa-star-half-alt text-primary"></i>' : '';
        $stars .= str_repeat('<i class="far fa-star text-primary"></i>', $emptyStars);

        return $stars;
    }
}
