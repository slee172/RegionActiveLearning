<?php

//
//	Copyright (c) 2014-2017, Emory University
//	All rights reserved.
//
//	Redistribution and use in source and binary forms, with or without modification, are
//	permitted provided that the following conditions are met:
//
//	1. Redistributions of source code must retain the above copyright notice, this list of
//	conditions and the following disclaimer.
//
//	2. Redistributions in binary form must reproduce the above copyright notice, this list
// 	of conditions and the following disclaimer in the documentation and/or other materials
//	provided with the distribution.
//
//	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
//	EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
//	OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT
//	SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
//	INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
//	TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR
//	BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
//	CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY
//	WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
//	DAMAGE.
//
//

	require '../db/logging.php';		// Also includes connect.php

	$application = $_POST['application'];
	$projectDir = $_POST['projectDir'];

	$array_features = array();
	// Open a directory, and read its contents
	if (is_dir($projectDir)){
	  if ($dh = opendir($projectDir)){
	    	while (($file = readdir($dh)) !== false){
					$info = pathinfo($file);
					if ($info["extension"] == "h5") {
						if ($application == "nuclei") {
							if ((strpos($file, 'pofeatures') === false) && (strpos($file, 'spfeatures') === false)) {
								$array_features[] = $file;
							}
						}	else if ($application == "region") {
							if (strpos($file, 'spfeatures') !== false) {
								$array_features[] = $file;
							}
						}	else if ($application == "cell") {
							if (strpos($file, 'pofeatures') !== false) {
								$array_features[] = $file;
							}
						}	else{
							log_error("Can't find ".$application);
						}
				 }
	    }
	    closedir($dh);
	  }
	}

	$response = array("featureName" => $array_features);

	echo json_encode($response);

	?>
