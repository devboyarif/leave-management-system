<?php

namespace App\Traits;

trait HasCountry
{
    public function getCountryCode($code)
    {
        switch ($code) {
            case 'au':
                return 'australian';
                break;
            case 'at':
                return 'austrian';
                break;
            case 'br':
                return 'brazilian';
                break;
            case 'ca':
                return 'canadian';
                break;
            case 'cn':
                return 'china';
                break;
            case 'dk':
                return 'danish';
                break;
            case 'fi':
                return 'finnish';
                break;
            case 'fr':
                return 'french';
                break;
            case 'de':
                return 'german';
                break;
            case 'gr':
                return 'greek';
                break;
            case 'hk':
                return 'hong_kong';
                break;
            case 'in':
                return 'indian';
                break;
            case 'id':
                return 'indonesian';
                break;
            case 'ie':
                return 'irish';
                break;
            case 'it':
                return 'italian';
                break;
            case 'jp':
                return 'japanese';
                break;
            case 'il':
                return 'jewish';
                break;
            case 'my':
                return 'malaysia';
                break;
            case 'mx':
                return 'mexican';
                break;
            case 'nz':
                return 'new_zealand';
                break;
            case 'no':
                return 'norwegian';
                break;
            case 'ph':
                return 'philippines';
                break;
            case 'pl':
                return 'polish';
                break;
            case 'pt':
                return 'portuguese';
                break;
            case 'ru':
                return 'russian';
                break;
            case 'sg':
                return 'singapore';
                break;
            case 'za':
                return 'sa';
                break;
            case 'es':
                return 'spain';
                break;
            case 'ko':
                return 'south_korea';
                break;
            case 'se':
                return 'swedish';
                break;
            case 'tw':
                return 'taiwan';
                break;
            case 'gb':
                return 'uk';
                break;
            case 'us':
                return 'usa';
                break;
            case 'um':
                return 'usa';
                break;
            case 'vn':
                return 'vietnamese';
                break;
            case 'an':
                return 'dutch';
                break;
            case 'nl':
                return 'dutch';
                break;
            case 'ro':
                return 'christian';
                break;
            default:
                return $code;
                break;
        }
    }
}
