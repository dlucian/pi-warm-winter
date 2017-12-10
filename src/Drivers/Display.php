<?php

namespace Warmer\Drivers;

class Display {
    
    public function show($outTemp, $inTemp) {
	$display = str_replace('.', '', sprintf('%5.1f%5.1f', $outTemp, $inTemp));
	$command = sprintf('./pi-tm1638-1.0/examples/tmp -l 0 -d "%s"', $display );
	echo "Running: " . $command . "\n";
	exec($command);
    }

    protected function ledTemp($input) {
       //return sprintf('
    }
}
