namespace App\Model\Entity;

use Cake\ORM\Entity;

class Donation extends Entity
{
    protected $_accessible = [
        'description' => true,
        'photo' => true,
        'latitude' => true,
        'longitude' => true,
        'status' => true,
        'user_id' => true,
    ];
}