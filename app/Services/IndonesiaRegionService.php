<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class IndonesiaRegionService
{
    private const BASE_URL = 'https://emsifa.github.io/api-wilayah-indonesia/api';

    /**
     * Get all provinces
     */
    public function getProvinces()
    {
        return Cache::remember('indonesian_provinces', 3600, function () {
            $response = Http::timeout(30)->get(self::BASE_URL . '/provinces.json');
            return $response->successful() ? $response->json() : [];
        });
    }

    /**
     * Get regencies by province ID
     */
    public function getRegencies($provinceId)
    {
        return Cache::remember("indonesian_regencies_{$provinceId}", 3600, function () use ($provinceId) {
            $response = Http::timeout(30)->get(self::BASE_URL . "/regencies/{$provinceId}.json");
            return $response->successful() ? $response->json() : [];
        });
    }

    /**
     * Get districts by regency ID
     */
    public function getDistricts($regencyId)
    {
        return Cache::remember("indonesian_districts_{$regencyId}", 3600, function () use ($regencyId) {
            $response = Http::timeout(30)->get(self::BASE_URL . "/districts/{$regencyId}.json");
            return $response->successful() ? $response->json() : [];
        });
    }

    /**
     * Get villages by district ID
     */
    public function getVillages($districtId)
    {
        return Cache::remember("indonesian_villages_{$districtId}", 3600, function () use ($districtId) {
            $response = Http::timeout(30)->get(self::BASE_URL . "/villages/{$districtId}.json");
            return $response->successful() ? $response->json() : [];
        });
    }

    /**
     * Find province by name
     */
    public function findProvinceByName($name)
    {
        $provinces = $this->getProvinces();
        return collect($provinces)->first(function ($province) use ($name) {
            return strcasecmp($province['name'], $name) === 0;
        });
    }

    /**
     * Find regency by name and province ID
     */
    public function findRegencyByName($name, $provinceId)
    {
        $regencies = $this->getRegencies($provinceId);
        return collect($regencies)->first(function ($regency) use ($name) {
            return strcasecmp($regency['name'], $name) === 0;
        });
    }
}
