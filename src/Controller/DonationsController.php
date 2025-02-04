namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\ForbiddenException;

class DonationsController extends AppController
{
    public function index()
    {
        $user = $this->Authentication->getIdentity();
        $donations = $this->Donations->find('nearby', [
            'latitude' => $user->latitude,
            'longitude' => $user->longitude,
            'radius' => 10
        ]);

        $this->set(compact('donations'));
    }

    public function add()
    {
        $donation = $this->Donations->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $user = $this->Authentication->getIdentity();
            $donationData = $this->request->getData();
            
            $location = $this->Donations->getGeolocation();
            
            $donationData['user_id'] = $user->id;
            $donationData['latitude'] = $location['latitude'];
            $donationData['longitude'] = $location['longitude'];
            $donationData['status'] = 'pending';

            $donation = $this->Donations->patchEntity($donation, $donationData);
            
            if ($this->Donations->save($donation)) {
                $this->Flash->success('Donation posted');
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error('Donation failed');
        }

        $this->set(compact('donation'));
    }

    public function pickup($id)
    {
        $donation = $this->Donations->get($id);
        $user = $this->Authentication->getIdentity();
        
        $currentLocation = $this->Donations->getGeolocation();
        $distance = $this->Donations->calculateDistance(
            $currentLocation, 
            $donation->latitude, 
            $donation->longitude
        );

        if ($distance > 50) {
            throw new ForbiddenException('Too far from donation');
        }

        $donation->status = 'picked_up';
        $donation->picked_up_by = $user->id;

        if ($this->Donations->save($donation)) {
            $this->Flash->success('Pickup confirmed');
        }

        return $this->redirect(['action' => 'index']);
    }
}