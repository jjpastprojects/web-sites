<?php

namespace Lembarek\Core\Countries;

class Countries
{
  //public static $CountriesLongAndShortNames =   array_combine;

    public static $CountriesLongNames =  [
    "afghanistan",
    "albania",
    "algeria",
    "american samoa",
    "andorra",
    "angola",
    "anguilla",
    "antarctica",
    "antigua and barbuda",
    "argentina",
    "armenia",
    "aruba",
    "australia",
    "austria",
    "azerbaijan",
    "bahamas",
    "bahrain",
    "bangladesh",
    "barbados",
    "belarus",
    "belgium",
    "belize",
    "benin",
    "bermuda",
    "bhutan",
    "bolivia",
    "bosnia and herzegowina",
    "botswana",
    "bouvet island",
    "brazil",
    "british indian ocean territory",
    "brunei darussalam",
    "bulgaria",
    "burkina faso",
    "burundi",
    "cambodia",
    "cameroon",
    "canada",
    "cabo verde",
    "cayman islands",
    "central african republic",
    "chad",
    "chile",
    "china",
    "christmas island",
    "cocos islands",
    "colombia",
    "comoros",
    "congo",
    "congo, the democratic republic of the",
    "cook islands",
    "costa rica",
    "cote d'ivoire",
    "croatia",
    "cuba",
    "cyprus",
    "czech republic",
    "denmark",
    "djibouti",
    "dominica",
    "dominican republic",
    "east timor",
    "ecuador",
    "egypt",
    "el salvador",
    "equatorial guinea",
    "eritrea",
    "estonia",
    "ethiopia",
    "falkland islands",
    "faroe islands",
    "fiji",
    "finland",
    "france",
    "french guiana",
    "french polynesia",
    "french southern territories",
    "gabon",
    "gambia",
    "georgia",
    "germany",
    "ghana",
    "gibraltar",
    "greece",
    "greenland",
    "grenada",
    "guadeloupe",
    "guam",
    "guatemala",
    "guinea",
    "guinea-bissau",
    "guyana",
    "haiti",
    "heard and mc donald islands",
    "holy see",
    "honduras",
    "hong kong",
    "hungary",
    "iceland",
    "india",
    "indonesia",
    "iran",
    "iraq",
    "ireland",
    "israel",
    "italy",
    "jamaica",
    "japan",
    "jordan",
    "kazakhstan",
    "kenya",
    "kiribati",
    "korea, democratic people's republic of",
    "korea, republic of",
    "kuwait",
    "kyrgyzstan",
    "lao, people's democratic republic",
    "latvia",
    "lebanon",
    "lesotho",
    "liberia",
    "libyan arab jamahiriya",
    "liechtenstein",
    "lithuania",
    "luxembourg",
    "macao",
    "macedonia, the former yugoslav republic of",
    "madagascar",
    "malawi",
    "malaysia",
    "maldives",
    "mali",
    "malta",
    "marshall islands",
    "martinique",
    "mauritania",
    "mauritius",
    "mayotte",
    "mexico",
    "micronesia, federated states of",
    "moldova, republic of",
    "monaco",
    "mongolia",
    "montserrat",
    "morocco",
    "mozambique",
    "myanmar",
    "namibia",
    "nauru",
    "nepal",
    "netherlands",
    "netherlands antilles",
    "new caledonia",
    "new zealand",
    "nicaragua",
    "niger",
    "nigeria",
    "niue",
    "norfolk island",
    "northern mariana islands",
    "norway",
    "oman",
    "pakistan",
    "palau",
    "panama",
    "papua new guinea",
    "paraguay",
    "peru",
    "philippines",
    "pitcairn",
    "poland",
    "portugal",
    "puerto rico",
    "qatar",
    "reunion",
    "romania",
    "russian federation",
    "rwanda",
    "saint kitts and nevis",
    "saint lucia",
    "saint vincent and the grenadines",
    "samoa",
    "san marino",
    "sao tome and principe",
    "saudi arabia",
    "senegal",
    "seychelles",
    "sierra leone",
    "singapore",
    "slovakia",
    "slovenia",
    "solomon islands",
    "somalia",
    "south africa",
    "south georgia and the south sandwich islands",
    "spain",
    "sri lanka",
    "st. helena",
    "st. pierre and miquelon",
    "sudan",
    "suriname",
    "svalbard and jan mayen islands",
    "swaziland",
    "sweden",
    "switzerland",
    "syrian arab republic",
    "taiwan, province of china",
    "tajikistan",
    "tanzania, united republic of",
    "thailand",
    "togo",
    "tokelau",
    "tonga",
    "trinidad and tobago",
    "tunisia",
    "turkey",
    "turkmenistan",
    "turks and caicos islands",
    "tuvalu",
    "uganda",
    "ukraine",
    "united arab emirates",
    "united kingdom",
    "united states",
    "united states minor outlying islands",
    "uruguay",
    "uzbekistan",
    "vanuatu",
    "venezuela",
    "vietnam",
    "virgin islands",
    "wallis and futuna islands",
    "western sahara",
    "yemen",
    "serbia",
    "zambia",
    "zimbabwe",
    ];
    public static $CountriesShortNames =  [
    "af",
    "al",
    "dz",
    "as",
    "ad",
    "ad",
    "ai",
    "aq",
    "ag",
    "ar",
    "am",
    "aw",
    "au",
    "at",
    "az",
    "bs",
    "bh",
    "bd",
    "bb",
    "by",
    "be",
    "bz",
    "bj",
    "bm",
    "bt",
    "bo",
    "ba",
    "bw",
    "bv",
    "br",
    "io",
    "bn",
    "bg",
    "bf",
    "bi",
    "kh",
    "cm",
    "ca",
    "cv",
    "ky",
    "cf",
    "td",
    "cl",
    "cn",
    "cx",
    "cc",
    "co",
    "km",
    "cg",
    "cd",
    "ck",
    "cr",
    "ci",
    "hr",
    "cu",
    "cy",
    "cz",
    "dk",
    "dj",
    "dm",
    "do",
    "tl",
    "ec",
    "eg",
    "sv",
    "gq",
    "er",
    "ee",
    "et",
    "fk",
    "fo",
    "fj",
    "fi",
    "fr",
    "gf",
    "pf",
    "tf",
    "ga",
    "gm",
    "ge",
    "de",
    "gh",
    "gi",
    "gr",
    "gl",
    "gd",
    "gp",
    "gu",
    "gt",
    "gn",
    "gw",
    "gy",
    "ht",
    "hm",
    "va",
    "hn",
    "hk",
    "hu",
    "is",
    "in",
    "id",
    "ir",
    "iq",
    "ie",
    "il",
    "it",
    "jm",
    "jp",
    "jo",
    "kz",
    "ke",
    "ki",
    "kp",
    "kr",
    "kw",
    "kg",
    "la",
    "lv",
    "lb",
    "ls",
    "lr",
    "ly",
    "li",
    "lt",
    "lu",
    "mo",
    "mk",
    "mg",
    "mw",
    "my",
    "mv",
    "ml",
    "mt",
    "mh",
    "mq",
    "mr",
    "mu",
    "yt",
    "mx",
    "fm",
    "md",
    "mc",
    "mn",
    "ms",
    "ma",
    "mz",
    "mm",
    "na",
    "nr",
    "np",
    "nl",
    "an",
    "nc",
    "nz",
    "ni",
    "ne",
    "ng",
    "nu",
    "nf",
    "mp",
    "no",
    "om",
    "pk",
    "pw",
    "pa",
    "pg",
    "py",
    "pe",
    "ph",
    "pn",
    "pl",
    "pt",
    "pr",
    "qa",
    "re",
    "ro",
    "ru",
    "rw",
    "kn",
    "lc",
    "vc",
    "ws",
    "sm",
    "st",
    "sa",
    "sn",
    "sc",
    "sl",
    "sg",
    "sk",
    "si",
    "sb",
    "so",
    "za",
    "gs",
    "es",
    "lk",
    "sh",
    "pm",
    "sd",
    "sr",
    "sj",
    "sz",
    "se",
    "ch",
    "sy",
    "tw",
    "tj",
    "tz",
    "th",
    "tg",
    "tk",
    "to",
    "tt",
    "tn",
    "tr",
    "tm",
    "tc",
    "tv",
    "ug",
    "ua",
    "ae",
    "gb",
    "us",
    "um",
    "uy",
    "uz",
    "vu",
    "ve",
    "vn",
    "vg",
    "vi",
    "wf",
    "eh",
    "ye",
    "yu",
    "zm",
    "zw",
    ];
}
