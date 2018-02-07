<?php

namespace Tools;

Trait Date_Locale
{
    public function getFrDate(\DateTime $date, $format = "%A %d %B %Y - %Hh%M"){
        return utf8_encode(strftime($format, $date->getTimestamp()));
    }

}