namespace App\Service;

class GeolocationService
{
    public function getCurrentLocation()
    {
        // IP-based geolocation fallback
        $ipInfo = $this->getLocationByIP();
        
        return [
            'latitude' => $ipInfo['latitude'] ?? 0,
            'longitude' => $ipInfo['longitude'] ?? 0
        ];
    }

    private function getLocationByIP()
    {
        // Simple IP geolocation logic
        $ip = $_SERVER['REMOTE_ADDR'];
        $geoData = @file_get_contents("https://ipapi.co/{$ip}/json/");
        
        return $geoData ? json_decode($geoData, true) : null;
    }

    public function calculateDistance($point1, $point2)
    {
        $earthRadius = 6371; // kilometers

        $latFrom = deg2rad($point1['latitude']);
        $lonFrom = deg2rad($point1['longitude']);
        $latTo = deg2rad($point2['latitude']);
        $lonTo = deg2rad($point2['longitude']);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(
            sqrt(
                pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)
            )
        );

        return $angle * $earthRadius * 1000; // meters
    }
}