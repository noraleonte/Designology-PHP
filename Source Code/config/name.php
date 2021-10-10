<?php
$primulNume = array("Rățușca", "Iepurașul", "Dinozaurul", "Cățelușul", "Maimuțica", "Pisicuța", "Puișorul", "Broscuța", "Șoricelul", "Caluțul", "Mielul", "Papagalul", "Oița", "Vulpița", "Lupul", "Peștișorul", "Dragonașul", "Corbul", "Vulturul", "Leuțul", "Tigrișorul", "Pantera", "Ursulețul", "Elefănțelul", "Girafa", "Ariciul", "Cârtița", "Omiduța", "Cangurul", "Țestoasa", "Măgărușul", "Norișorul", "Căprioara", "Curcanul", "Fazanul", "Lama", "Lebăda", "Poneiul", "Ștruțul", "Rechinul", "Delfinul");
// $alDoileaNumeNeutru = array("de ciocolată");
$alDoileaNumeFeminin = array("de ciocolată", "veselă", "ambițioasă", "optimistă", "pufoasă", "activă", "parfumată", "abilă", "ascultătoare", "atentă", "blândă", "bună", "cinstită", "creativă", "cumpătată", "curajoasă", "determinată", "discretă", "elocventă", "entuziastă", "fermă", "flexibilă", "harnică", "iertătoare", "înțeleaptă", "loială", "mărinimoasă", "meticuloasă", "mulțumită", "oneastă", "ordonată", "prudentă", "punctuală", "răbdătoare", "recunoscătoare", "responsabilă", "sensibilă", "sigură", "sinceră", "umilă", "respectuoasă", "modestă", "smernică", "tolerantă", "vigilentă", "virtuoasă", "voioasă", "punctuală", "justă", "generoasă", "minunată", "hotărâtă", "draguță", "elegantă", "vorbăreață", "dulce", "amuzantă", "fabuloasă", "uimitoare", "perfectă", "serioasă", "calmă", "misterioasă", "muncitoare", "jucăușă", "energică", "iubită", "amabilă", "frumoasă", "curiosă", "magică", "prețioasă", "de jucărie", "cuminte", "de pluș", "de zahăr");
$alDoileaNumeMasculin = array("de ciocolată", "vesel", "ambițios", "optimist", "pufos", "activ", "parfumat", "abil", "ascultător", "atent", "blând", "bun", "cinstit", "creativ", "cumpătat", "curajos", "determinat", "discret", "elocvent", "entuziast", "ferm", "flexibil", "harnic", "iertător", "înțelept", "loial", "mărinimos", "meticulos", "mulțumit", "onest", "ordonat", "prudent", "punctual", "răbdător", "recunoscător", "responsabil", "sensibil", "sigur", "sincer", "umil", "respectuos", "modest", "smernic", "tolerant", "vigilent", "virtuos", "voios", "punctual", "just", "generos", "minunat", "hotărât", "drăguț", "elegant", "vorbăreț", "dulce", "amuzant", "fabulos", "uimitor", "perfect", "serios", "calm", "misterios", "muncitor", "jucăuș", "energic", "iubit", "amabil", "frumos", "curios", "magic", "prețios", "de jucărie", "cuminte");
$alTreileaNumeFeminin = array("albă", "maronie", "albastră", "roșie", "gri", "indigo", "turcoaz", "verde", "roz", "galbenă", "portocalie", "crem", "neagră", "vișinie", "argintie", "aurie", "azurie", "bej", "bordo", "brună", "blondă", "cafenie", "kaki", "ciocolatie", "mică", "mare");
$alTreileaNumeMasculin = array("alb", "maroniu", "albastru", "roșu", "gri", "indigo", "turcoaz", "verde", "roz", "galben", "portocaliu", "crem", "negru", "vișiniu", "argintiu", "auriu", "azuriu", "bej", "bordo", "brun", "blond", "cafeniu", "kaki", "ciocolatiu", "mic", "mare");

function genulAdjectivului($numeAles, $alCateleaNume)
{
    global $alDoileaNumeFeminin, $alDoileaNumeMasculin, $alTreileaNumeFeminin, $alTreileaNumeMasculin;
    if ($alCateleaNume === 2) {
        if (substr($numeAles, -1) === "a") {
            return $alDoileaNumeFeminin[array_rand($alDoileaNumeFeminin)];
        } else {
            return $alDoileaNumeMasculin[array_rand($alDoileaNumeMasculin)];
        }
    }

    if ($alCateleaNume === 3) {
        if (substr($numeAles, -1) === "a") {
            return $alTreileaNumeFeminin[array_rand($alTreileaNumeFeminin)];
        } else {
            return $alTreileaNumeMasculin[array_rand($alTreileaNumeMasculin)];
        }
    }
}

function generateName()
{
    global $primulNume;
    $primulNumeAles = $primulNume[array_rand($primulNume)];
    return $primulNumeAles . " " . genulAdjectivului($primulNumeAles, 2) . " " . genulAdjectivului($primulNumeAles, 3);
}
