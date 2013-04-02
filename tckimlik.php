<?php

class tckimlik {

  private $tc;

	public function __construct($tc)
	{
		$this->tc = $tc;
	}

	public function dogrula()
	{
		return $this->test();
	}

	private function test()
	{
		$impossible = array(
			'11111111110',
			'22222222220',
			'33333333330',
			'44444444440',
			'55555555550',
			'66666666660',
			'7777777770',
			'88888888880',
			'99999999990'
		);

    	if ( $this->tc[0]==0 || !ctype_digit($this->tc) || strlen($this->tc)!=11) {
    		return false;
    	} else {
        	for ( $a=0;$a<9;$a=$a+2)
        		$first=$first+$this->tc[$a];
        	for ( $a=1;$a<9;$a=$a+2)
        		$last=$last+$this->tc[$a];
        	for ( $a=0;$a<10;$a=$a+1)
        		$all=$all+$this->tc[$a];

        	if ( ( $first*7-$last )%10!=$this->tc[9] || $all%10!=$this->tc[10]) {
        		return false;
        	} else {
            	foreach ($impossible as $item) {
            		if($this->tc==$item)
            			return false;
            	}
            	return true;
        	}
    	}
	}

}
