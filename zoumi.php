<?php
//
include 'filetypes.php';
//
function getDirs($target) {
	// Help Vars
	$lvl = -1;
	$lvl_dif = 0;
	$isf = 0;
	$ign = 0;
	// Get File 2 Read
	$handle = fopen('dirs/'.$target, "r");
	if ($handle) {
		// Init Output
		echo '<ul>';
		// Loop Lines
		while (($line = fgets($handle)) !== false) {
			// Handle End Of File + Empty Lines
			if (trim($line) == ':eof:') break;
			if (trim($line) == '') continue;
			// Flag Comments
			if (trim($line) == '/*') {
				$ign = 1;
				continue;
			}
			if (trim($line) == '*/') {
				$ign = 0;
				continue;
			}
			if ($ign) continue;
			// Level CP
			if (strspn(rtrim($line), "\t") < $lvl) {
				// Parent LVL
				$lvl_dif = $lvl - strspn(rtrim($line), "\t");
				if (!$isf) {$lvl_dif++;}
				for ($i=0; $i < $lvl_dif; $i++) { 
					echo '</ul></li>';
				}
			}
			else if (strspn(rtrim($line), "\t") == $lvl && $isf == 0) {
				// Same LVL
				echo '</ul></li>';
			}
			else {
				// Child LVL: NULL
			}
			// Store "Level"
			$lvl = strspn(rtrim($line), "\t");
			// Create ID for Checkboxes
			$cid = substr(md5(rand()), 0, 7);
			// Output Node
			if (substr(trim($line), 1, 1) == '|') {
				// Case: "Dir"
				echo '<li data-type="dir"';
				echo ' data-lvl="'.$lvl.'">';
				// State (Open / Closed) Checkbox
				echo '<input type="checkbox" id="'.$cid.'"';
				echo (substr(trim($line), 0, 1) == '-') ? ' checked>' : '>';
				// Folder (Open / Closed) Icons
				echo '<span class="icon-folder"></span>';
				echo '<span class="icon-folder-open"></span>';
				// Print Folder Name
				echo '<label class="" for="'.$cid.'">';
				echo substr(trim($line), 2);
				echo '</label>';
				// Init Children
				echo '<ul>';
				// Store Prev Output
				$isf = 0;
			}
			else {
				// Case: "File"
				echo '<li data-type="file"';
				echo ' data-lvl="'.$lvl.'">';
				// Extension "icon"
				// echo '<img src="icons/file_type_'.substr($line, strrpos($line, '.') + 1).'.png">';
				// echo '<span class="icon-'.substr($line, strrpos($line, '.') + 1).'"></span>';
				echo '<span class="icon-'.getExt($line).'"></span>';
				// Print Name + Extension
				echo trim(substr($line, 0, strrpos($line, '.')));
				echo '<span class="grey">'.substr($line, strrpos($line, '.')).'</span>';
				// Close Line
				echo '</li>';
				// Store Prev Output
				$isf = 1;
			}
		}
		// Close Handle
		fclose($handle);
		// eof Output
		echo '</ul>';
	}
	else {echo 'Error opening the file :(';}
}

?>