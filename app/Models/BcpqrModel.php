<?php

namespace App\Models ;

use CodeIgniter\Model; 

    class BcpqrModel extends Model {
        protected $table = 'bcpqr';
        protected $primaryKey = 'bcpqr_id';
        protected $allowedFields = ['bcpqr_coin', 'bcpqr_amount', 'bcpqr_reference', 'bcpqr_expiration', 'bcpqr_image'];
    }

?>