<?php

function urlExist($url) {
    $file_headers = @get_headers($url);
    var_dump($file_headers);
    if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return false;
    }
    return true;
}

urlExist('http://cdnv.kcdn.tn/iptv/ch1034?code=580011964942723');
urlExist('http://mn-i.mncdn.com/alhiwar_live/smil:alhiwar.smil/playlist.m3u8');
urlExist('http://cdnv.kcdn.tn/iptv/ch201?code=580011964942723');

?>