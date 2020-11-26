<?php

namespace App\Models ;

use CodeIgniter\Model; 

    class PersonModel extends Model {
        protected $table = 'person';
        protected $primaryKey = 'person_id';
        protected $allowedFields = ['person_firstname', 'person_lastname', 'person_email', 'person_phone', 'person_country', 'person_department', 'person_location'];
    }