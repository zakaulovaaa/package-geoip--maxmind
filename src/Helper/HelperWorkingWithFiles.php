<?php


namespace GeoIp\Helper;


use ZipArchive;

class HelperWorkingWithFiles
{
    public static function unzipData(string $pathFile, string $pathDir): void
    {
        $zip = new ZipArchive();
        if ($zip->open($pathFile) === true) {
            $zip->extractTo($pathDir);
            $zip->close();
        } else {
            throw new \RuntimeException("failed to open archive<br>");
        }
    }

    public static function downloadData(string $url, string $pathDir, string $pathArchive): void
    {
        //check is empty url to data
        if ($url === "") {
            throw new \Exception("no link to download the database");
        }

        // create temporary dir
        if (!file_exists($pathDir)) {
            if (!mkdir($pathDir, 0777, true) && !is_dir($pathDir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $pathDir));
            }
        }

        //download data
        $file = fopen($pathArchive, 'w');
        $ch = \curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FILE, $file);
        curl_exec($ch);
        curl_close($ch);
        fclose($file);

        //check is empty archive
        if (!filesize($pathArchive)) {
            throw new \Exception("the archive was not downloaded");
        }
    }


}