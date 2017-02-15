<?php

require_once('vendor/autoload.php');

$pathInput = $argv[1] ?? '/tmp/images/';
$pathOutput = $argv[2] ?? '/tmp/images/';
$tinifyAPIKey = $argv[3] ?? 'L33T-R2D2';

$imageTypes = [
	image_type_to_mime_type(IMAGETYPE_PNG),
	image_type_to_mime_type(IMAGETYPE_JPEG)
];

function getAllFilesAndFoldersInPath($path, $recursive = false, &$fileList = []){
	$files = scandir($path);
	foreach($files as $file){
		$filePath = realpath($path . DIRECTORY_SEPARATOR . $file);
		if(false === is_dir($filePath)) {
			$fileList[] = $filePath;
		} else if($file != '.' && $file != '..') {
			if(true === $recursive) {
				getAllFilesAndFoldersInPath($filePath, $recursive, $fileList);
			}
			$fileList[] = $filePath;
		}
	}

	return $fileList;
}

function replacePathPrefixInList(array $fileList, $prefix, $replacement = '') {
	foreach ($fileList as &$file) {
		if(strpos($file, $prefix, 0) === 0) {
			$file = preg_replace('/^' . preg_quote($prefix, '/') . '/i', $replacement, $file, 1);
		}
		else {
			// abort - one or more of the files are NOT prefixed with the prefix-path
			return false;
		}
	}
	return $fileList;
}

// check API connection
try {
	\Tinify\setKey($tinifyAPIKey);
	\Tinify\validate();
} catch(\Tinify\Exception $e) {
	die('Tinify API error: ' . $e->getMessage() . PHP_EOL);
}

// check directories
if(false === is_readable($pathInput) || false === is_writable($pathOutput)) {
	die('Permission error - Please check given directories' . PHP_EOL);
}

// get directory content
$fileListWithAbsolutePath = getAllFilesAndFoldersInPath($pathInput, true);
$fileList = replacePathPrefixInList($fileListWithAbsolutePath, $pathInput);
if(true === empty($fileList)) {
	die('Directory is empty!' . PHP_EOL);
}

// compress images
$finfo = new finfo;
foreach ($fileList as $file) {
	if(in_array($finfo->file($pathInput . $file, FILEINFO_MIME_TYPE), $imageTypes)) {
		\Tinify\fromFile($pathInput . $file)->toFile($pathOutput. $file);
		echo $pathInput . $file . ' → ' . $pathOutput. $file . PHP_EOL;
	}
}
echo 'Done' . PHP_EOL;

echo PHP_EOL . 'API usage this month: ' . \Tinify\compressionCount() . ' compressed images' . PHP_EOL;
