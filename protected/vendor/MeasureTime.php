<?php
 
class MeasureTime
{
    private $_timeparts;
    private $_starttime;
 
    public function start() {
            $this->_timeparts = explode(" ",microtime());
            $this->_starttime = $this->_timeparts[1].substr($this->_timeparts[0],1);
            $this->_timeparts = explode(" ",microtime());
    }
 
    public function end() {
            $endtime = $this->_timeparts[1].substr($this->_timeparts[0],1);
            return bcsub($endtime,$this->_starttime,6);
    }
 
}
