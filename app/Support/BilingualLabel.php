<?php

namespace App\Support;

class BilingualLabel
{
    public static function category(?string $value): string
    {
        return match ($value) {
            'flood' => 'Flood (বন্যা)',
            'cyclone' => 'Cyclone (ঘূর্ণিঝড়)',
            'road_blocked' => 'Road Blocked (রাস্তা বন্ধ)',
            'building_damage' => 'Building Damage (ভবনের ক্ষতি)',
            'medical_emergency' => 'Medical Emergency (চিকিৎসা জরুরি)',
            'shelter_needed' => 'Shelter Needed (আশ্রয়কেন্দ্র প্রয়োজন)',
            'other' => 'Other (অন্যান্য)',
            default => 'Unknown (অজানা)',
        };
    }

    public static function urgency(?string $value): string
    {
        return match ($value) {
            'low' => 'Low (কম)',
            'medium' => 'Medium (মাঝারি)',
            'high' => 'High (উচ্চ)',
            'critical' => 'Critical (গুরুতর)',
            default => 'Unknown (অজানা)',
        };
    }

    public static function reportStatus(?string $value): string
    {
        return match ($value) {
            'pending' => 'Pending (অপেক্ষমাণ)',
            'verified' => 'Verified (যাচাই করা হয়েছে)',
            'rejected' => 'Rejected (বাতিল)',
            'resolved' => 'Resolved (সমাধান হয়েছে)',
            'under_review' => 'Under Review (পর্যালোচনাধীন)',
            default => 'Unknown (অজানা)',
        };
    }

    public static function riskLevel(?string $value): string
    {
        return match ($value) {
            'Safe' => 'Safe (নিরাপদ)',
            'Advisory' => 'Advisory (সতর্কতামূলক)',
            'Warning' => 'Warning (সতর্কতা)',
            'Critical' => 'Critical (গুরুতর ঝুঁকি)',
            'Unavailable' => 'Unavailable (উপলব্ধ নয়)',
            'Processing' => 'Processing (প্রক্রিয়াধীন)',
            default => 'Processing (প্রক্রিয়াধীন)',
        };
    }

    public static function shelterStatus(?string $value): string
    {
        return match ($value) {
            'available' => 'Available (উপলব্ধ)',
            'limited' => 'Limited (সীমিত)',
            'full' => 'Full (পূর্ণ)',
            'closed' => 'Closed (বন্ধ)',
            default => 'Unknown (অজানা)',
        };
    }

    public static function facility(?string $value): string
    {
        return match ($value) {
            'drinking_water' => 'Drinking Water (পানীয় পানি)',
            'toilet' => 'Toilet (টয়লেট)',
            'medical_support' => 'Medical Support (চিকিৎসা সহায়তা)',
            'women_safe_space' => 'Women Safe Space (নারীদের নিরাপদ স্থান)',
            'child_support' => 'Child Support (শিশু সহায়তা)',
            'electricity' => 'Electricity (বিদ্যুৎ)',
            'food_support' => 'Food Support (খাদ্য সহায়তা)',
            'pet_allowed' => 'Pet Allowed (পোষা প্রাণী অনুমোদিত)',
            default => ucfirst(str_replace('_', ' ', (string) $value)),
        };
    }
}