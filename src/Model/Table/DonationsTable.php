namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class DonationsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->belongsTo('Users');
    }

    public function findNearby($query, $options)
    {
        return $query->where(function ($exp) use ($options) {
            return $exp->between(
                $this->aliasField('latitude'), 
                $options['latitude'] - 0.1, 
                $options['latitude'] + 0.1
            );
        });
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmpty('description')
            ->requirePresence('photo')
            ->numeric('latitude')
            ->numeric('longitude');

        return $validator;
    }

    public function getGeolocation()
    {
        // IP or browser-based geolocation logic
        return [
            'latitude' => 0,
            'longitude' => 0
        ];
    }

    public function calculateDistance($location1, $lat2, $lon2)
    {
        $lat1 = $location1['latitude'];
        $lon1 = $location1['longitude'];

        $r = 6371; // Earth radius in kilometers
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        return $r * $c * 1000; // Convert to meters
    }
}