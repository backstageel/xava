<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prefix()
    {
        return $this->belongsTo(PersonPrefix::class, 'person_prefix_id');
    }

    public function civilStates()
    {
        return $this->belongsTo(CivilState::class, 'civil_state_id');
    }

    public function typeOfIdentityDocument()
    {
        return $this->belongsTo(IdentityDocumentType::class, 'identity_document_type_id');
    }

    public function countryOfBirth()
    {
        return $this->belongsTo(Country::class, 'birth_country_id');
    }

    public function provinceOfBirth()
    {
        return $this->belongsTo(Province::class, 'birth_province_id');
    }

    public function districtOfBirth()
    {
        return $this->belongsTo(District::class, 'birth_district_id');
    }

    public function countryOfAddress()
    {
        return $this->belongsTo(Country::class, 'address_country_id');
    }

    public function provinceOfAddress()
    {
        return $this->belongsTo(Province::class, 'address_province_id');
    }

    public function districtOfAddress()
    {
        return $this->belongsTo(District::class, 'address_district_id');
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function customer()
    {
        return $this->morphOne(Customer::class, 'customerable');
    }

    public function supplier()
    {
        return $this->morphOne(Supplier::class, 'supplierable');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name'],
        );
    }

}
