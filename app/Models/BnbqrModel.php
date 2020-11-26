<?php

namespace App\Models ;

use CodeIgniter\Model; 

    class BnbqrModel extends Model {
        protected $table = 'bnbqr';
        protected $primaryKey = 'bnbqr_id';
        protected $allowedFields = ['bnbqr_coin', 'bnbqr_amount', 'bnbqr_reference', 'bnbqr_expiration', 'bnbqr_singleuse', 'bnbqr_date', 'bnbqr_image'];
    }

?>