<?php


function calcpoints($chapters)
{
    $nr_points = 0;
    if (array_filter($chapters)) {

        foreach ($chapters as $c) {
            $nr_points += $c['points'];
        }
    }
    return $nr_points;
}

function convertURL($txt)
{
    $txt = removeDiacritics($txt);
    $txt = strtolower($txt);
    $newtxt = str_replace(" ", "-", $txt);
    return $newtxt;
}

function cutLongText($txt, $nr)
{
    if (strlen($txt) > $nr) {
        $txt1 = substr($txt, 0, $nr);
        $txt1 = $txt1 . "...";
        return $txt1;
    } else {
        return $txt;
    }
}
function splitStr($txt, $chr)
{
}

function removeDiacritics($txt)
{
    $search = array('ă', 'î', 'â', 'ș', 'ț', 'Ă', 'Î', 'Â', 'Ș', 'Ț');
    $replace = array('a', 'i', 'a', 's', 't', 'A', 'I', 'A', 'S', 'T');
    $txt = str_replace($search, $replace, $txt);
    return $txt;
}
