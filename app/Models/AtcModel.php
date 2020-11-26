<?php

namespace App\Models ;

use CodeIgniter\Model; 

    class AtcModel extends Model {
        protected $table = 'atc';
        protected $primaryKey = 'atc_id';
        protected $allowedFields = ['atc_amount', 'atc_number', 'atc_cvv', 'atc_expiration', 'atc_date'];
    }