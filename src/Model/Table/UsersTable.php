namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->hasMany('Donations');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->email('email')
            ->notEmpty('email', 'Email is required')
            ->add('email', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Email already in use'
            ])
            ->requirePresence('password')
            ->notEmpty('password', 'Password is required');

        return $validator;
    }
}