<div class="donations-map">
    <?php foreach ($donations as $donation): ?>
        <div class="donation-pin" 
             data-lat="<?= $donation->latitude ?>" 
             data-lon="<?= $donation->longitude ?>">
            <img src="<?= $donation->photo_path ?>" alt="Donation">
            <p><?= $donation->description ?></p>
            <button class="pickup-btn" data-id="<?= $donation->id ?>">
                Pickup
            </button>
        </div>
    <?php endforeach; ?>
</div>