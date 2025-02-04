namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity
{
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'name' => true,
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher())->hash($password);
    }
}