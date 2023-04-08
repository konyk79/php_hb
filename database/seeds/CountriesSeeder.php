<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First things first
        Country::create([
            'code' => 'US',
            'en'=>['name' => 'United States'],
            'ru'=>['name' => 'США'],
        ]);
        Country::create([
            'code' => 'UA',
            'en'=>['name' => 'Ukraine'],
            'ru'=>['name' => 'Украина'],
        ]);
        Country::create([
            'code' => 'RU',
            'en'=>['name' => 'Russia'],
            'ru'=>['name' => 'Россия'],
        ]);
        Country::create([
            'code' => 'LV',
            'en'=>['name' => 'Latvia'],
            'ru'=>['name' => 'Латвия'],
        ]);

        // Other contries
        //'AF': 'Afghanistan',
        Country::create([
            'code' => 'AF',
            'en'=>['name' => 'Afghanistan'],
            'ru'=>['name' => 'Авганистан'],
        ]);
        //'AL': 'Albania',
        Country::create([
            'code' => 'AL',
            'en'=>['name' => 'Albania'],
            'ru'=>['name' => 'Албания'],
        ]);
        //'DZ': 'Algeria',
        Country::create([
            'code' => 'DZ',
            'en'=>['name' => 'Algeria'],
            'ru'=>['name' => 'Алжир'],
        ]);
        //'AS': 'American Samoa',
        Country::create([
            'code' => 'AS',
            'en'=>['name' => 'American Samoa'],
            'ru'=>['name' => 'Американское Самоа'],
        ]);
        //'AD': 'Andorra',
        Country::create([
            'code' => 'AD',
            'en'=>['name' => 'Andorra'],
            'ru'=>['name' => 'Андорра'],
        ]);
        //'AO': 'Angola',
        Country::create([
            'code' => 'AO',
            'en'=>['name' => 'Angola'],
            'ru'=>['name' => 'Ангола'],
        ]);
        //'AI': 'Anguilla',
        Country::create([
            'code' => 'AI',
            'en'=>['name' => 'Anguilla'],
            'ru'=>['name' => 'Ангилья'],
        ]);
        //'AQ': 'Antarctica',
//        Country::create([
//            'code' => 'AQ',
//            'en'=>['name' => 'Antarctica'],
//            'ru'=>['name' => 'Антарктида'],
//        ]);
        //'AG': 'Antigua and Barbuda',
        Country::create([
            'code' => 'AG',
            'en'=>['name' => 'Antigua and Barbuda'],
            'ru'=>['name' => 'Антигуа и Барбуда'],
        ]);
        //'AR': 'Argentina',
        Country::create([
            'code' => 'AR',
            'en'=>['name' => 'Argentina'],
            'ru'=>['name' => 'Аргентина'],
        ]);
        //'AM': 'Armenia',
        Country::create([
            'code' => 'AM',
            'en'=>['name' => 'Armenia'],
            'ru'=>['name' => 'Армения'],
        ]);
        //'AW': 'Aruba',
        Country::create([
            'code' => 'AW',
            'en'=>['name' => 'Aruba'],
            'ru'=>['name' => 'Аруба'],
        ]);
        //'AU': 'Australia',
        Country::create([
            'code' => 'AU',
            'en'=>['name' => 'Australia'],
            'ru'=>['name' => 'Австралия'],
        ]);
        //'AT': 'Austria',
        Country::create([
            'code' => 'AT',
            'en'=>['name' => 'Austria'],
            'ru'=>['name' => 'Австрия'],
        ]);
        //'AZ': 'Azerbaijan',
        Country::create([
            'code' => 'AZ',
            'en'=>['name' => 'Azerbaijan'],
            'ru'=>['name' => 'Азербайджан'],
        ]);
        //'BH': 'Bahrain',
        Country::create([
            'code' => 'BH',
            'en'=>['name' => 'Bahrain'],
            'ru'=>['name' => 'Бахрейн'],
        ]);
        //'BD': 'Bangladesh',
        Country::create([
            'code' => 'BD',
            'en'=>['name' => 'Bangladesh'],
            'ru'=>['name' => 'Бангладеш'],
        ]);
        //'BB': 'Barbados',
        Country::create([
            'code' => 'BB',
            'en'=>['name' => 'Barbados'],
            'ru'=>['name' => 'Барбадос'],
        ]);
        //'BY': 'Belarus',
        Country::create([
            'code' => 'BY',
            'en'=>['name' => 'Belarus'],
            'ru'=>['name' => 'Беларусь'],
        ]);
        //'BE': 'Belgium',
        Country::create([
            'code' => 'BE',
            'en'=>['name' => 'Belgium'],
            'ru'=>['name' => 'Бельгия'],
        ]);
        //'BZ': 'Belize',
        Country::create([
            'code' => 'BZ',
            'en'=>['name' => 'Belize'],
            'ru'=>['name' => 'Белиз'],
        ]);
        //'BJ': 'Benin',
        Country::create([
            'code' => 'BJ',
            'en'=>['name' => 'Benin'],
            'ru'=>['name' => 'Бенин'],
        ]);
        //'BM': 'Bermuda',
        Country::create([
            'code' => 'BM',
            'en'=>['name' => 'Bermuda'],
            'ru'=>['name' => 'Бермудские острова'],
        ]);
        //'BT': 'Bhutan',
        Country::create([
            'code' => 'BT',
            'en'=>['name' => 'Bhutan'],
            'ru'=>['name' => 'Бутан'],
        ]);
        //'BO': 'Bolivia',
        Country::create([
            'code' => 'BO',
            'en'=>['name' => 'Bolivia'],
            'ru'=>['name' => 'Боливия'],
        ]);
        //'BA': 'Bosnia and Herzegovina',
        Country::create([
            'code' => 'BA',
            'en'=>['name' => 'Bosnia and Herzegovina'],
            'ru'=>['name' => 'Босния и Герцеговина'],
        ]);
        //'BW': 'Botswana',
        Country::create([
            'code' => 'BW',
            'en'=>['name' => 'Botswana'],
            'ru'=>['name' => 'Ботсвана'],
        ]);
        //'BV': 'Bouvet Island',
        Country::create([
            'code' => 'BV',
            'en'=>['name' => 'Bouvet Island'],
            'ru'=>['name' => 'Остров Буве'],
        ]);
        //'BR': 'Brazil',
        Country::create([
            'code' => 'BR',
            'en'=>['name' => 'Brazil'],
            'ru'=>['name' => 'Бразилия'],
        ]);
        //'IO': 'British Indian Ocean Territory',
        Country::create([
            'code' => 'IO',
            'en'=>['name' => 'British Indian Ocean Territory'],
            'ru'=>['name' => 'Британская Территория в Индийском Океане'],
        ]);
        //'VG': 'British Virgin Islands',
        Country::create([
            'code' => 'VG',
            'en'=>['name' => 'British Virgin Islands'],
            'ru'=>['name' => 'Виргинские Острова Великобритания'],
        ]);
        //'BN': 'Brunei',
        Country::create([
            'code' => 'BN',
            'en'=>['name' => 'Brunei'],
            'ru'=>['name' => 'Бруней'],
        ]);
        //'BG': 'Bulgaria',
        Country::create([
            'code' => 'BG',
            'en'=>['name' => 'Bulgaria'],
            'ru'=>['name' => 'Болгария'],
        ]);
        //'BF': 'Burkina Faso',
        Country::create([
            'code' => 'BF',
            'en'=>['name' => 'Burkina Faso'],
            'ru'=>['name' => 'Буркина-Фасо'],
        ]);
        //'BI': 'Burundi',
        Country::create([
            'code' => 'BI',
            'en'=>['name' => 'Burundi'],
            'ru'=>['name' => 'Бурунди'],
        ]);
        //'CI': 'Côte d\'Ivoire',
        Country::create([
            'code' => 'CI',
            'en'=>['name' => 'Côte d\'Ivoire'],
            'ru'=>['name' => 'Кот-д\'Ивуар'],
        ]);
        //'KH': 'Cambodia',
        Country::create([
            'code' => 'KH',
            'en'=>['name' => 'Cambodia'],
            'ru'=>['name' => 'Камбоджа'],
        ]);
        //'CM': 'Cameroon',
        Country::create([
            'code' => 'CM',
            'en'=>['name' => 'Cameroon'],
            'ru'=>['name' => 'Камерун'],
        ]);
        //'CA': 'Canada',
        Country::create([
            'code' => 'CA',
            'en'=>['name' => 'Canada'],
            'ru'=>['name' => 'Канада'],
        ]);
        //'CV': 'Cape Verde',
        Country::create([
            'code' => 'CV',
            'en'=>['name' => 'Cape Verde'],
            'ru'=>['name' => 'Кабо-Верде'],
        ]);
        //'KY': 'Cayman Islands',
        Country::create([
            'code' => 'KY',
            'en'=>['name' => 'Cayman Islands'],
            'ru'=>['name' => 'Острова Кайман'],
        ]);
        //'CF': 'Central African Republic',
        Country::create([
            'code' => 'CF',
            'en'=>['name' => 'Central African Republic'],
            'ru'=>['name' => 'Центральноафриканская Республика'],
        ]);
        //'TD': 'Chad',
        Country::create([
            'code' => 'TD',
            'en'=>['name' => 'Chad'],
            'ru'=>['name' => 'Чад'],
        ]);
        //'CL': 'Chile',
        Country::create([
            'code' => 'CL',
            'en'=>['name' => 'Chile'],
            'ru'=>['name' => 'Чили'],
        ]);
        //'CN': 'China',
        Country::create([
            'code' => 'CN',
            'en'=>['name' => 'China'],
            'ru'=>['name' => 'Китай'],
        ]);
        //'CX': 'Christmas Island',
        Country::create([
            'code' => 'CX',
            'en'=>['name' => 'Christmas Island'],
            'ru'=>['name' => 'Остров Рождества'],
        ]);
        //'CC': 'Cocos (Keeling) Islands',
        Country::create([
            'code' => 'CC',
            'en'=>['name' => 'Cocos (Keeling) Islands'],
            'ru'=>['name' => 'Кокосовые Килинг Острова'],
        ]);
        //'CO': 'Colombia',
        Country::create([
            'code' => 'CO',
            'en'=>['name' => 'Colombia'],
            'ru'=>['name' => 'Колумбия'],
        ]);
        //'KM': 'Comoros',
        Country::create([
            'code' => 'KM',
            'en'=>['name' => 'Comoros'],
            'ru'=>['name' => 'Коморские Острова'],
        ]);
        //'CG': 'Congo',
        Country::create([
            'code' => 'CG',
            'en'=>['name' => 'Congo'],
            'ru'=>['name' => 'Конго'],
        ]);
        //'CK': 'Cook Islands',
        Country::create([
            'code' => 'CK',
            'en'=>['name' => 'Cook Islands'],
            'ru'=>['name' => 'Острова Кука'],
        ]);
        //'CR': 'Costa Rica',
        Country::create([
            'code' => 'CR',
            'en'=>['name' => 'Costa Rica'],
            'ru'=>['name' => 'Коста-Рика'],
        ]);
        //'HR': 'Croatia',
        Country::create([
            'code' => 'HR',
            'en'=>['name' => 'Croatia'],
            'ru'=>['name' => 'Хорватия'],
        ]);
        //'CU': 'Cuba',
        Country::create([
            'code' => 'CU',
            'en'=>['name' => 'Cuba'],
            'ru'=>['name' => 'Куба'],
        ]);
        //'CY': 'Cyprus',
        Country::create([
            'code' => 'CY',
            'en'=>['name' => 'Cyprus'],
            'ru'=>['name' => 'Кипр'],
        ]);
        //'CZ': 'Czech Republic',
        Country::create([
            'code' => 'CZ',
            'en'=>['name' => 'Czech Republic'],
            'ru'=>['name' => 'Чехия'],
        ]);
        //'CD': 'Democratic Republic of the Congo',
        Country::create([
            'code' => 'CD',
            'en'=>['name' => 'Democratic Republic of the Congo'],
            'ru'=>['name' => 'Демократическая Республика Конго'],
        ]);
        //'DK': 'Denmark',
        Country::create([
            'code' => 'DK',
            'en'=>['name' => 'Denmark'],
            'ru'=>['name' => 'Дания'],
        ]);
        //'DJ': 'Djibouti',
        Country::create([
            'code' => 'DJ',
            'en'=>['name' => 'Djibouti'],
            'ru'=>['name' => 'Джибути'],
        ]);
        //'DM': 'Dominica',
        Country::create([
            'code' => 'DM',
            'en'=>['name' => 'Dominica'],
            'ru'=>['name' => 'Доминика'],
        ]);
        //'DO': 'Dominican Republic',
        Country::create([
            'code' => 'DO',
            'en'=>['name' => 'Dominican Republic'],
            'ru'=>['name' => 'Доминиканская Республика'],
        ]);
        //'TP': 'East Timor',
        Country::create([
            'code' => 'TP',
            'en'=>['name' => 'East Timor'],
            'ru'=>['name' => 'Восточный Тимор'],
        ]);
        //'EC': 'Ecuador',
        Country::create([
            'code' => 'EC',
            'en'=>['name' => 'Ecuador'],
            'ru'=>['name' => 'Эквадор'],
        ]);
        //'EG': 'Egypt',
        Country::create([
            'code' => 'EG',
            'en'=>['name' => 'Egypt'],
            'ru'=>['name' => 'Египет'],
        ]);
        //'SV': 'El Salvador',
        Country::create([
            'code' => 'SV',
            'en'=>['name' => 'El Salvador'],
            'ru'=>['name' => 'Сальвадор'],
        ]);
        //'GQ': 'Equatorial Guinea',
        Country::create([
            'code' => 'GQ',
            'en'=>['name' => 'Equatorial Guinea'],
            'ru'=>['name' => 'Экваториальная Гвинея'],
        ]);
        //'ER': 'Eritrea',
        Country::create([
            'code' => 'ER',
            'en'=>['name' => 'Eritrea'],
            'ru'=>['name' => 'Эритрея'],
        ]);
        //'EE': 'Estonia',
        Country::create([
            'code' => 'EE',
            'en'=>['name' => 'Estonia'],
            'ru'=>['name' => 'Эстония'],
        ]);
        //'ET': 'Ethiopia',
        Country::create([
            'code' => 'ET',
            'en'=>['name' => 'Ethiopia'],
            'ru'=>['name' => 'Эфиопия'],
        ]);
        //'FO': 'Faeroe Islands',
        Country::create([
            'code' => 'FO',
            'en'=>['name' => 'Faeroe Islands'],
            'ru'=>['name' => 'Фарерские Острова'],
        ]);
        //'FK': 'Falkland Islands',
        Country::create([
            'code' => 'FK',
            'en'=>['name' => 'Falkland Islands'],
            'ru'=>['name' => 'Фолклендские Острова'],
        ]);
        //'FJ': 'Fiji',
        Country::create([
            'code' => 'FJ',
            'en'=>['name' => 'Fiji'],
            'ru'=>['name' => 'Фиджи'],
        ]);
        //'FI': 'Finland',
        Country::create([
            'code' => 'FI',
            'en'=>['name' => 'Finland'],
            'ru'=>['name' => 'Финляндия'],
        ]);
        //'MK': 'Former Yugoslav Republic of Macedonia',
        Country::create([
            'code' => 'MK',
            'en'=>['name' => 'Macedonia'],
            'ru'=>['name' => 'Македония'],
        ]);
        //'FR': 'France',
        Country::create([
            'code' => 'FR',
            'en'=>['name' => 'France'],
            'ru'=>['name' => 'Франция'],
        ]);
        //'FX': 'France, Metropolitan',
        Country::create([
            'code' => 'FX',
            'en'=>['name' => 'France, Metropolitan'],
            'ru'=>['name' => 'Французская Метрополия'],
        ]);
        //'GF': 'French Guiana',
        Country::create([
            'code' => 'GF',
            'en'=>['name' => 'French Guiana'],
            'ru'=>['name' => 'Гвиана'],
        ]);
        //'PF': 'French Polynesia',
        Country::create([
            'code' => 'PF',
            'en'=>['name' => 'French Polynesia'],
            'ru'=>['name' => 'Французская Полинезия'],
        ]);
        //'TF': 'French Southern Territories',
        Country::create([
            'code' => 'TF',
            'en'=>['name' => 'French Southern Territories'],
            'ru'=>['name' => 'Французские Юж и Антаркт Тер'],
        ]);
        //'GA': 'Gabon',
        Country::create([
            'code' => 'GA',
            'en'=>['name' => 'Gabon'],
            'ru'=>['name' => 'Габон'],
        ]);
        //'GE': 'Georgia',
        Country::create([
            'code' => 'GE',
            'en'=>['name' => 'Georgia'],
            'ru'=>['name' => 'Грузия'],
        ]);
        //'DE': 'Germany',
        Country::create([
            'code' => 'DE',
            'en'=>['name' => 'Germany'],
            'ru'=>['name' => 'Германия'],
        ]);
        //'GH': 'Ghana',
        Country::create([
            'code' => 'GH',
            'en'=>['name' => 'Ghana'],
            'ru'=>['name' => 'Гана'],
        ]);
        //'GI': 'Gibraltar',
        Country::create([
            'code' => 'GI',
            'en'=>['name' => 'Gibraltar'],
            'ru'=>['name' => 'Гибралтар'],
        ]);
        //'GR': 'Greece',
        Country::create([
            'code' => 'GR',
            'en'=>['name' => 'Greece'],
            'ru'=>['name' => 'Греция'],
        ]);
        //'GL': 'Greenland',
        Country::create([
            'code' => 'GL',
            'en'=>['name' => 'Greenland'],
            'ru'=>['name' => 'Гренландия'],
        ]);
        //'GD': 'Grenada',
        Country::create([
            'code' => 'GD',
            'en'=>['name' => 'Grenada'],
            'ru'=>['name' => 'Гренада'],
        ]);
        //'GP': 'Guadeloupe',
        Country::create([
            'code' => 'GP',
            'en'=>['name' => 'Guadeloupe'],
            'ru'=>['name' => 'Гваделупа'],
        ]);
        //'GU': 'Guam',
        Country::create([
            'code' => 'GU',
            'en'=>['name' => 'Guam'],
            'ru'=>['name' => 'Гуам'],
        ]);
        //'GT': 'Guatemala',
        Country::create([
            'code' => 'GT',
            'en'=>['name' => 'Guatemala'],
            'ru'=>['name' => 'Гватемала'],
        ]);
        //'GN': 'Guinea',
        Country::create([
            'code' => 'GN',
            'en'=>['name' => 'Guinea'],
            'ru'=>['name' => 'Гвинея'],
        ]);
        //'GW': 'Guinea-Bissau',
        Country::create([
            'code' => 'GW',
            'en'=>['name' => 'Guinea-Bissau'],
            'ru'=>['name' => 'Гвинея-Бисау'],
        ]);
        //'GY': 'Guyana',
        Country::create([
            'code' => 'GY',
            'en'=>['name' => 'Guyana'],
            'ru'=>['name' => 'Гайана'],
        ]);
        //'HT': 'Haiti',
        Country::create([
            'code' => 'HT',
            'en'=>['name' => 'Haiti'],
            'ru'=>['name' => 'Гаити'],
        ]);
        //'HM': 'Heard and Mc Donald Islands',
        Country::create([
            'code' => 'HM',
            'en'=>['name' => 'Heard and Mc Donald Islands'],
            'ru'=>['name' => 'Херд и острова Макдональд'],
        ]);
        //'HN': 'Honduras',
        Country::create([
            'code' => 'HN',
            'en'=>['name' => 'Honduras'],
            'ru'=>['name' => 'Гондурас'],
        ]);
        //'HK': 'Hong Kong',
        Country::create([
            'code' => 'HK',
            'en'=>['name' => 'Hong Kong'],
            'ru'=>['name' => 'Гонконг'],
        ]);
        //'HU': 'Hungary',
        Country::create([
            'code' => 'HU',
            'en'=>['name' => 'Hungary'],
            'ru'=>['name' => 'Венгрия'],
        ]);
        //'IS': 'Iceland',
        Country::create([
            'code' => 'IS',
            'en'=>['name' => 'Iceland'],
            'ru'=>['name' => 'Исландия'],
        ]);
        //'IN': 'India',
        Country::create([
            'code' => 'IN',
            'en'=>['name' => 'India'],
            'ru'=>['name' => 'Индия'],
        ]);
        //'ID': 'Indonesia',
        Country::create([
            'code' => 'ID',
            'en'=>['name' => 'Indonesia'],
            'ru'=>['name' => 'Индонезия'],
        ]);
        //'IR': 'Iran',
        Country::create([
            'code' => 'IR',
            'en'=>['name' => 'Iran'],
            'ru'=>['name' => 'Иран'],
        ]);
        //'IQ': 'Iraq',
        Country::create([
            'code' => 'IQ',
            'en'=>['name' => 'Iraq'],
            'ru'=>['name' => 'Ирак'],
        ]);
        //'IE': 'Ireland',
        Country::create([
            'code' => 'IE',
            'en'=>['name' => 'Ireland'],
            'ru'=>['name' => 'Ирландия'],
        ]);
        //'IL': 'Israel',
        Country::create([
            'code' => 'IL',
            'en'=>['name' => 'Israel'],
            'ru'=>['name' => 'Израиль'],
        ]);
        //'IT': 'Italy',
        Country::create([
            'code' => 'IT',
            'en'=>['name' => 'Italy'],
            'ru'=>['name' => 'Италия'],
        ]);
        //'JM': 'Jamaica',
        Country::create([
            'code' => 'JM',
            'en'=>['name' => 'Jamaica'],
            'ru'=>['name' => 'Ямайка'],
        ]);
        //'JP': 'Japan',
        Country::create([
            'code' => 'JP',
            'en'=>['name' => 'Japan'],
            'ru'=>['name' => 'Япония'],
        ]);
        //'JO': 'Jordan',
        Country::create([
            'code' => 'JO',
            'en'=>['name' => 'Jordan'],
            'ru'=>['name' => 'Иордания'],
        ]);
        //'KZ': 'Kazakhstan',
        Country::create([
            'code' => 'KZ',
            'en'=>['name' => 'Kazakhstan'],
            'ru'=>['name' => 'Казахстан'],
        ]);
        //'KE': 'Kenya',
        Country::create([
            'code' => 'KE',
            'en'=>['name' => 'Kenya'],
            'ru'=>['name' => 'Кения'],
        ]);
        //'KI': 'Kiribati',
        Country::create([
            'code' => 'KI',
            'en'=>['name' => 'Kiribati'],
            'ru'=>['name' => 'Кирибати'],
        ]);
        //'KW': 'Kuwait',
        Country::create([
            'code' => 'KW',
            'en'=>['name' => 'Kuwait'],
            'ru'=>['name' => 'Кувейт'],
        ]);
        //'KG': 'Kyrgyzstan',
        Country::create([
            'code' => 'KG',
            'en'=>['name' => 'Kyrgyzstan'],
            'ru'=>['name' => 'Кыргызстан'],
        ]);
        //'LA': 'Laos',
        Country::create([
            'code' => 'LA',
            'en'=>['name' => 'Laos'],
            'ru'=>['name' => 'Лаос'],
        ]);
        //'LV': 'Latvia',
        //'LB': 'Lebanon',
        Country::create([
            'code' => 'LB',
            'en'=>['name' => 'Lebanon'],
            'ru'=>['name' => 'Ливан'],
        ]);
        //'LS': 'Lesotho',
        Country::create([
            'code' => 'LS',
            'en'=>['name' => 'Lesotho'],
            'ru'=>['name' => 'Лесото'],
        ]);
        //'LR': 'Liberia',
        Country::create([
            'code' => 'LR',
            'en'=>['name' => 'Liberia'],
            'ru'=>['name' => 'Либерия'],
        ]);
        //'LY': 'Libya',
        Country::create([
            'code' => 'LY',
            'en'=>['name' => 'Libya'],
            'ru'=>['name' => 'Ливия'],
        ]);
        //'LI': 'Liechtenstein',
        Country::create([
            'code' => 'LI',
            'en'=>['name' => 'Liechtenstein'],
            'ru'=>['name' => 'Лихтенштейн'],
        ]);
        //'LT': 'Lithuania',
        Country::create([
            'code' => 'LT',
            'en'=>['name' => 'Lithuania'],
            'ru'=>['name' => 'Литва'],
        ]);
        //'LU': 'Luxembourg',
        Country::create([
            'code' => 'LU',
            'en'=>['name' => 'Luxembourg'],
            'ru'=>['name' => 'Люксембург'],
        ]);
        //'MO': 'Macau',
        Country::create([
            'code' => 'MO',
            'en'=>['name' => 'Macau'],
            'ru'=>['name' => 'Макао'],
        ]);
        //'MG': 'Madagascar',
        Country::create([
            'code' => 'MG',
            'en'=>['name' => 'Madagascar'],
            'ru'=>['name' => 'Мадагаскар'],
        ]);
        //'MW': 'Malawi',
        Country::create([
            'code' => 'MW',
            'en'=>['name' => 'Malawi'],
            'ru'=>['name' => 'Малави'],
        ]);
        //'MY': 'Malaysia',
        Country::create([
            'code' => 'MY',
            'en'=>['name' => 'Malaysia'],
            'ru'=>['name' => 'Малайзия'],
        ]);
        //'MV': 'Maldives',
        Country::create([
            'code' => 'MV',
            'en'=>['name' => 'Maldives'],
            'ru'=>['name' => 'Мальдивы'],
        ]);
        //'ML': 'Mali',
        Country::create([
            'code' => 'ML',
            'en'=>['name' => 'Mali'],
            'ru'=>['name' => 'Мали'],
        ]);
        //'MT': 'Malta',
        Country::create([
            'code' => 'MT',
            'en'=>['name' => 'Malta'],
            'ru'=>['name' => 'Мальта'],
        ]);
        //'MH': 'Marshall Islands',
        Country::create([
            'code' => 'MH',
            'en'=>['name' => 'Marshall Islands'],
            'ru'=>['name' => 'Маршалловы Острова'],
        ]);
        //'MQ': 'Martinique',
        Country::create([
            'code' => 'MQ',
            'en'=>['name' => 'Martinique'],
            'ru'=>['name' => 'Мартиника'],
        ]);
        //'MR': 'Mauritania',
        Country::create([
            'code' => 'MR',
            'en'=>['name' => 'Mauritania'],
            'ru'=>['name' => 'Мавритания'],
        ]);
        //'MU': 'Mauritius',
        Country::create([
            'code' => 'MU',
            'en'=>['name' => 'Mauritius'],
            'ru'=>['name' => 'Маврикий'],
        ]);
        //'YT': 'Mayotte',
        Country::create([
            'code' => 'YT',
            'en'=>['name' => 'Mayotte'],
            'ru'=>['name' => 'Майотта'],
        ]);
        //'MX': 'Mexico',
        Country::create([
            'code' => 'MX',
            'en'=>['name' => 'Mexico'],
            'ru'=>['name' => 'Мексика'],
        ]);
        //'FM': 'Micronesia',
        Country::create([
            'code' => 'FM',
            'en'=>['name' => 'Micronesia'],
            'ru'=>['name' => 'Микронезия'],
        ]);
        //'MD': 'Moldova',
        Country::create([
            'code' => 'MD',
            'en'=>['name' => 'Moldova'],
            'ru'=>['name' => 'Молдова'],
        ]);
        //'MC': 'Monaco',
        Country::create([
            'code' => 'MC',
            'en'=>['name' => 'Monaco'],
            'ru'=>['name' => 'Монако'],
        ]);
        //'MN': 'Mongolia',
        Country::create([
            'code' => 'MN',
            'en'=>['name' => 'Mongolia'],
            'ru'=>['name' => 'Монголия'],
        ]);
        //'ME': 'Montenegro',
        Country::create([
            'code' => 'ME',
            'en'=>['name' => 'Montenegro'],
            'ru'=>['name' => 'Монтенегро'],
        ]);
        //'MS': 'Montserrat',
        Country::create([
            'code' => 'MS',
            'en'=>['name' => 'Montserrat'],
            'ru'=>['name' => 'Монтсеррат'],
        ]);
        //'MA': 'Morocco',
        Country::create([
            'code' => 'MA',
            'en'=>['name' => 'Morocco'],
            'ru'=>['name' => 'Марокко'],
        ]);
        //'MZ': 'Mozambique',
        Country::create([
            'code' => 'MZ',
            'en'=>['name' => 'Mozambique'],
            'ru'=>['name' => 'Мозамбик'],
        ]);
        //'MM': 'Myanmar',
        Country::create([
            'code' => 'MM',
            'en'=>['name' => 'Myanmar'],
            'ru'=>['name' => 'Мьянма'],
        ]);
        //'NA': 'Namibia',
        Country::create([
            'code' => 'NA',
            'en'=>['name' => 'Namibia'],
            'ru'=>['name' => 'Намибия'],
        ]);
        //'NR': 'Nauru',
        Country::create([
            'code' => 'NR',
            'en'=>['name' => 'Nauru'],
            'ru'=>['name' => 'Науру'],
        ]);
        //'NP': 'Nepal',
        Country::create([
            'code' => 'NP',
            'en'=>['name' => 'Nepal'],
            'ru'=>['name' => 'Непал'],
        ]);
        //'NL': 'Netherlands',
        Country::create([
            'code' => 'NL',
            'en'=>['name' => 'Netherlands'],
            'ru'=>['name' => 'Нидерланды'],
        ]);
        //'AN': 'Netherlands Antilles',
        Country::create([
            'code' => 'AN',
            'en'=>['name' => 'Netherlands Antilles'],
            'ru'=>['name' => 'Нидерландские Антильские Острова'],
        ]);
        //'NC': 'New Caledonia',
        Country::create([
            'code' => 'NC',
            'en'=>['name' => 'New Caledonia'],
            'ru'=>['name' => 'Новая Каледония'],
        ]);
        //'NZ': 'New Zealand',
        Country::create([
            'code' => 'NZ',
            'en'=>['name' => 'New Zealand'],
            'ru'=>['name' => 'Новая Зеландия'],
        ]);
        //'NI': 'Nicaragua',
        Country::create([
            'code' => 'NI',
            'en'=>['name' => 'Nicaragua'],
            'ru'=>['name' => 'Никарагуа'],
        ]);
        //'NE': 'Niger',
        Country::create([
            'code' => 'NE',
            'en'=>['name' => 'Niger'],
            'ru'=>['name' => 'Нигер'],
        ]);
        //'NG': 'Nigeria',
        Country::create([
            'code' => 'NG',
            'en'=>['name' => 'Nigeria'],
            'ru'=>['name' => 'Нигерия'],
        ]);
        //'NU': 'Niue',
        Country::create([
            'code' => 'NU',
            'en'=>['name' => 'Niue'],
            'ru'=>['name' => 'Ниуэ'],
        ]);
        //'NF': 'Norfolk Island',
        Country::create([
            'code' => 'NF',
            'en'=>['name' => 'Norfolk Island'],
            'ru'=>['name' => 'Норфолк остров'],
        ]);
        //'KP': 'North Korea',
        Country::create([
            'code' => 'KP',
            'en'=>['name' => 'North Korea'],
            'ru'=>['name' => 'Северная Корея'],
        ]);
        //'MP': 'Northern Marianas',
        Country::create([
            'code' => 'MP',
            'en'=>['name' => 'Northern Marianas'],
            'ru'=>['name' => 'Северные Марианские Острова'],
        ]);
        //'NO': 'Norway',
        Country::create([
            'code' => 'NO',
            'en'=>['name' => 'Norway'],
            'ru'=>['name' => 'Норвегия'],
        ]);
        //'OM': 'Oman',
        Country::create([
            'code' => 'OM',
            'en'=>['name' => 'Oman'],
            'ru'=>['name' => 'Оман'],
        ]);
        //'PK': 'Pakistan',
        Country::create([
            'code' => 'PK',
            'en'=>['name' => 'Pakistan'],
            'ru'=>['name' => 'Пакистан'],
        ]);
        //'PW': 'Palau',
        Country::create([
            'code' => 'PW',
            'en'=>['name' => 'Palau'],
            'ru'=>['name' => 'Палау'],
        ]);
        //'PS': 'Palestine',
        Country::create([
            'code' => 'PS',
            'en'=>['name' => 'Palestine'],
            'ru'=>['name' => 'Палестина'],
        ]);
        //'PA': 'Panama',
        Country::create([
            'code' => 'PA',
            'en'=>['name' => 'Panama'],
            'ru'=>['name' => 'Панама'],
        ]);
        //'PG': 'Papua New Guinea',
        Country::create([
            'code' => 'PG',
            'en'=>['name' => 'Papua New Guinea'],
            'ru'=>['name' => 'Папуа-Новая Гвинея'],
        ]);
        //'PY': 'Paraguay',
        Country::create([
            'code' => 'PY',
            'en'=>['name' => 'Paraguay'],
            'ru'=>['name' => 'Парагвая'],
        ]);
        //'PE': 'Peru',
        Country::create([
            'code' => 'PE',
            'en'=>['name' => 'Peru'],
            'ru'=>['name' => 'Перу'],
        ]);
        //'PH': 'Philippines',
        Country::create([
            'code' => 'PH',
            'en'=>['name' => 'Philippines'],
            'ru'=>['name' => 'Филиппины'],
        ]);
        //'PN': 'Pitcairn Islands',
        Country::create([
            'code' => 'PN',
            'en'=>['name' => 'Pitcairn Islands'],
            'ru'=>['name' => 'Острова Питкэрн'],
        ]);
        //'PL': 'Poland',
        Country::create([
            'code' => 'PL',
            'en'=>['name' => 'Poland'],
            'ru'=>['name' => 'Польша'],
        ]);
        //'PT': 'Portugal',
        Country::create([
            'code' => 'PT',
            'en'=>['name' => 'Portugal'],
            'ru'=>['name' => 'Португалия'],
        ]);
        //'PR': 'Puerto Rico',
        Country::create([
            'code' => 'PR',
            'en'=>['name' => 'Puerto Rico'],
            'ru'=>['name' => 'Пуэрто-Рико'],
        ]);
        //'QA': 'Qatar',
        Country::create([
            'code' => 'QA',
            'en'=>['name' => 'Qatar'],
            'ru'=>['name' => 'Катар'],
        ]);
        //'RE': 'Reunion',
        Country::create([
            'code' => 'RE',
            'en'=>['name' => 'Reunion'],
            'ru'=>['name' => 'Реюньон'],
        ]);
        //'RO': 'Romania',
        Country::create([
            'code' => 'RO',
            'en'=>['name' => 'Romania'],
            'ru'=>['name' => 'Румыния'],
        ]);
        //'RU': 'Russia',
        //'RW': 'Rwanda',
        Country::create([
            'code' => 'RW',
            'en'=>['name' => 'Rwanda'],
            'ru'=>['name' => 'Руанда'],
        ]);
        //'ST': 'São Tomé and Príncipe',
        Country::create([
            'code' => 'ST',
            'en'=>['name' => 'São Tomé and Príncipe'],
            'ru'=>['name' => 'Сан-Томе и Принсипи'],
        ]);
        //'SH': 'Saint Helena',
        Country::create([
            'code' => 'SH',
            'en'=>['name' => 'Saint Helena'],
            'ru'=>['name' => 'Остров Святой Елены'],
        ]);
        //'PM': 'St. Pierre and Miquelon',
        Country::create([
            'code' => 'PM',
            'en'=>['name' => 'St. Pierre and Miquelon'],
            'ru'=>['name' => 'Сен-Пьер и Микелон'],
        ]);
        //'KN': 'Saint Kitts and Nevis',
        Country::create([
            'code' => 'KN',
            'en'=>['name' => 'Saint Kitts and Nevis'],
            'ru'=>['name' => 'Сент-Китс и Невис'],
        ]);
        //'LC': 'Saint Lucia',
        Country::create([
            'code' => 'LC',
            'en'=>['name' => 'Saint Lucia'],
            'ru'=>['name' => 'Сент-Люсия'],
        ]);
        //'VC': 'Saint Vincent and the Grenadines',
        Country::create([
            'code' => 'VC',
            'en'=>['name' => 'Saint Vincent and the Grenadines'],
            'ru'=>['name' => 'Сент-Винсент и Гренадины'],
        ]);
        //'WS': 'Samoa',
        Country::create([
            'code' => 'WS',
            'en'=>['name' => 'Samoa'],
            'ru'=>['name' => 'Самоа'],
        ]);
        //'SM': 'San Marino',
        Country::create([
            'code' => 'SM',
            'en'=>['name' => 'San Marino'],
            'ru'=>['name' => 'Сан-Марино'],
        ]);
        //'SA': 'Saudi Arabia',
        Country::create([
            'code' => 'SA',
            'en'=>['name' => 'Saudi Arabia'],
            'ru'=>['name' => 'Саудовская Аравия'],
        ]);
        //'SN': 'Senegal',
        Country::create([
            'code' => 'SN',
            'en'=>['name' => 'Senegal'],
            'ru'=>['name' => 'Сенегал'],
        ]);
        //'RS': 'Serbia',
        Country::create([
            'code' => 'RS',
            'en'=>['name' => 'Serbia'],
            'ru'=>['name' => 'Сербия'],
        ]);
        //'SC': 'Seychelles',
        Country::create([
            'code' => 'SC',
            'en'=>['name' => 'Seychelles'],
            'ru'=>['name' => 'Сейшельские Острова'],
        ]);
        //'SL': 'Sierra Leone',
        Country::create([
            'code' => 'SL',
            'en'=>['name' => 'Sierra Leone'],
            'ru'=>['name' => 'Сьерра-Леоне'],
        ]);
        //'SG': 'Singapore',
        Country::create([
            'code' => 'SG',
            'en'=>['name' => 'Singapore'],
            'ru'=>['name' => 'Сингапур'],
        ]);
        //'SK': 'Slovakia',
        Country::create([
            'code' => 'SK',
            'en'=>['name' => 'Slovakia'],
            'ru'=>['name' => 'Словакия'],
        ]);
        //'SI': 'Slovenia',
        Country::create([
            'code' => 'SI',
            'en'=>['name' => 'Slovenia'],
            'ru'=>['name' => 'Словения'],
        ]);
        //'SB': 'Solomon Islands',
        Country::create([
            'code' => 'SB',
            'en'=>['name' => 'Solomon Islands'],
            'ru'=>['name' => 'Соломоновы Острова'],
        ]);
        //'SO': 'Somalia',
        Country::create([
            'code' => 'SO',
            'en'=>['name' => 'Somalia'],
            'ru'=>['name' => 'Сомали'],
        ]);
        //'ZA': 'South Africa',
        Country::create([
            'code' => 'ZA',
            'en'=>['name' => 'South Africa'],
            'ru'=>['name' => '>ЮАР'],
        ]);
        //'GS': 'South Georgia and the South Sandwich Islands',
        Country::create([
            'code' => 'GS',
            'en'=>['name' => 'South Georgia and the South Sandwich Islands'],
            'ru'=>['name' => 'Южная Георгия и Южн Сандвичевы о-ва'],
        ]);
        //'KR': 'South Korea',
        Country::create([
            'code' => 'KR',
            'en'=>['name' => 'South Korea'],
            'ru'=>['name' => 'Южная Корея'],
        ]);
        //'ES': 'Spain',
        Country::create([
            'code' => 'ES',
            'en'=>['name' => 'Spain'],
            'ru'=>['name' => 'Испания'],
        ]);
        //'LK': 'Sri Lanka',
        Country::create([
            'code' => 'LK',
            'en'=>['name' => 'Sri Lanka'],
            'ru'=>['name' => 'Шри-Ланка'],
        ]);
        //'SD': 'Sudan',
        Country::create([
            'code' => 'SD',
            'en'=>['name' => 'Sudan'],
            'ru'=>['name' => 'Судан'],
        ]);
        //'SR': 'Suriname',
        Country::create([
            'code' => 'SR',
            'en'=>['name' => 'Suriname'],
            'ru'=>['name' => 'Суринам'],
        ]);
        //'SJ': 'Svalbard and Jan Mayen Islands',
        Country::create([
            'code' => 'SJ',
            'en'=>['name' => 'Svalbard and Jan Mayen Islands'],
            'ru'=>['name' => 'Шпицберген и Ян-Майен'],
        ]);
        //'SZ': 'Swaziland',
        Country::create([
            'code' => 'SZ',
            'en'=>['name' => 'Swaziland'],
            'ru'=>['name' => 'Свазиленд'],
        ]);
        //'SE': 'Sweden',
        Country::create([
            'code' => 'SE',
            'en'=>['name' => 'Sweden'],
            'ru'=>['name' => 'Швеция'],
        ]);
        //'CH': 'Switzerland',
        Country::create([
            'code' => 'CH',
            'en'=>['name' => 'Switzerland'],
            'ru'=>['name' => 'Швейцария'],
        ]);
        //'SY': 'Syria',
        Country::create([
            'code' => 'SY',
            'en'=>['name' => 'Syria'],
            'ru'=>['name' => 'Сирия'],
        ]);
        //'TW': 'Taiwan',
        Country::create([
            'code' => 'TW',
            'en'=>['name' => 'Taiwan'],
            'ru'=>['name' => 'Тайвань'],
        ]);
        //'TJ': 'Tajikistan',
        Country::create([
            'code' => 'TJ',
            'en'=>['name' => 'Tajikistan'],
            'ru'=>['name' => 'Таджикистан'],
        ]);
        //'TZ': 'Tanzania',
        Country::create([
            'code' => 'TZ',
            'en'=>['name' => 'Tanzania'],
            'ru'=>['name' => 'Танзания'],
        ]);
        //'TH': 'Thailand',
        Country::create([
            'code' => 'TH',
            'en'=>['name' => 'Thailand'],
            'ru'=>['name' => 'Тайланд'],
        ]);
        //'BS': 'The Bahamas',
        Country::create([
            'code' => 'BS',
            'en'=>['name' => 'The Bahamas'],
            'ru'=>['name' => 'Багамские Острова'],
        ]);
        //'GM': 'The Gambia',
        Country::create([
            'code' => 'GM',
            'en'=>['name' => 'The Gambia'],
            'ru'=>['name' => 'Гамбия'],
        ]);
        //'TG': 'Togo',
        Country::create([
            'code' => 'TG',
            'en'=>['name' => 'Togo'],
            'ru'=>['name' => 'Того'],
        ]);
        //'TK': 'Tokelau',
        Country::create([
            'code' => 'TK',
            'en'=>['name' => 'Tokelau'],
            'ru'=>['name' => 'Токелау'],
        ]);
        //'TO': 'Tonga',
        Country::create([
            'code' => 'TO',
            'en'=>['name' => 'Tonga'],
            'ru'=>['name' => 'Тонга'],
        ]);
        //'TT': 'Trinidad and Tobago',
        Country::create([
            'code' => 'TT',
            'en'=>['name' => 'Trinidad and Tobago'],
            'ru'=>['name' => 'Тринидад и Тобаго'],
        ]);
        //'TN': 'Tunisia',
        Country::create([
            'code' => 'TN',
            'en'=>['name' => 'Tunisia'],
            'ru'=>['name' => 'Тунис'],
        ]);
        //'TR': 'Turkey',
        Country::create([
            'code' => 'TR',
            'en'=>['name' => 'Turkey'],
            'ru'=>['name' => 'Турция'],
        ]);
        //'TM': 'Turkmenistan',
        Country::create([
            'code' => 'TM',
            'en'=>['name' => 'Turkmenistan'],
            'ru'=>['name' => 'Туркменистан'],
        ]);
        //'TC': 'Turks and Caicos Islands',
        Country::create([
            'code' => 'TC',
            'en'=>['name' => 'Turks and Caicos Islands'],
            'ru'=>['name' => 'Тёркс и Кайкос'],
        ]);
        //'TV': 'Tuvalu',
        Country::create([
            'code' => 'TV',
            'en'=>['name' => 'Tuvalu'],
            'ru'=>['name' => 'Тувалу'],
        ]);
        //'VI': 'US Virgin Islands',
        Country::create([
            'code' => 'VI',
            'en'=>['name' => 'US Virgin Islands'],
            'ru'=>['name' => 'Виргинские Острова США'],
        ]);
        //'UG': 'Uganda',
        Country::create([
            'code' => 'UG',
            'en'=>['name' => 'Uganda'],
            'ru'=>['name' => 'Уганда'],
        ]);
        //'UA': 'Ukraine',
        //'AE': 'United Arab Emirates',
        Country::create([
            'code' => 'AE',
            'en'=>['name' => 'United Arab Emirates'],
            'ru'=>['name' => 'ОАЭ'],
        ]);
        //'GB': 'United Kingdom',
        Country::create([
            'code' => 'GB',
            'en'=>['name' => 'United Kingdom'],
            'ru'=>['name' => 'Великобритания'],
        ]);
        //'US': 'United States',
        //'UM': 'United States Minor Outlying Islands',
        Country::create([
            'code' => 'UM',
            'en'=>['name' => 'United States Minor Outlying Islands'],
            'ru'=>['name' => 'Внешние малые острова США'],
        ]);
        //'UY': 'Uruguay',
        Country::create([
            'code' => 'UY',
            'en'=>['name' => 'Uruguay'],
            'ru'=>['name' => 'Уругвай'],
        ]);
        //'UZ': 'Uzbekistan',
        Country::create([
            'code' => 'UZ',
            'en'=>['name' => 'Uzbekistan'],
            'ru'=>['name' => 'Узбекистан'],
        ]);
        //'VU': 'Vanuatu',
        Country::create([
            'code' => 'VU',
            'en'=>['name' => 'Vanuatu'],
            'ru'=>['name' => 'Вануату'],
        ]);
        //'VA': 'Vatican City',
        Country::create([
            'code' => 'VA',
            'en'=>['name' => 'Vatican City'],
            'ru'=>['name' => 'Ватикан'],
        ]);
        //'VE': 'Venezuela',
        Country::create([
            'code' => 'VE',
            'en'=>['name' => 'Venezuela'],
            'ru'=>['name' => 'Венесуэла'],
        ]);
        //'VN': 'Vietnam',
        Country::create([
            'code' => 'VN',
            'en'=>['name' => 'Vietnam'],
            'ru'=>['name' => 'Вьетнам'],
        ]);
        //'WF': 'Wallis and Futuna Islands',
        Country::create([
            'code' => 'WF',
            'en'=>['name' => 'Wallis and Futuna Islands'],
            'ru'=>['name' => 'острова Уоллис и Футуна'],
        ]);
        //'EH': 'Western Sahara',
        Country::create([
            'code' => 'EH',
            'en'=>['name' => 'Western Sahara'],
            'ru'=>['name' => 'Западная Сахара'],
        ]);
        //'YE': 'Yemen',
        Country::create([
            'code' => 'YE',
            'en'=>['name' => 'Yemen'],
            'ru'=>['name' => 'Йемен'],
        ]);
        //'ZM': 'Zambia',
        Country::create([
            'code' => 'ZM',
            'en'=>['name' => 'Zambia'],
            'ru'=>['name' => 'Замбия'],
        ]);
        //'CW': 'Curacao',
        Country::create([
            'code' => 'CW',
            'en'=>['name' => 'Curacao'],
            'ru'=>['name' => 'Кюрасао'],
        ]);
        //'ZW': 'Zimbabwe'
        Country::create([
            'code' => 'ZW',
            'en'=>['name' => 'Zimbabwe'],
            'ru'=>['name' => 'Зимбабве'],
        ]);
    }
}
