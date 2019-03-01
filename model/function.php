<?php
function getsdate($date)
{
    $ret = strtotime($date);
    $ret2 = getdate($ret);
    switch($ret2['mon'])
    {
        case 1:
            return $ret2['mday']." janvier ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 2:
            return $ret2['mday']." février ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 3:
            return $ret2['mday']." mars ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 4:
            return $ret2['mday']." avril ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 5:
            return $ret2['mday']." mai ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 6:
            return $ret2['mday']." juin ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 7:
            return $ret2['mday']." juillet ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 8:
            return $ret2['mday']." aôut ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 9:
            return $ret2['mday']." septembre ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 10:
            return $ret2['mday']." octobre ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 11:
            return $ret2['mday']." novembre ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
        case 12:
            return $ret2['mday']." décembre ".$ret2['year']." à ".$ret2['hours']." h ".$ret2['minutes']." min ".$ret2['seconds'];
        break;
    }
}

?>