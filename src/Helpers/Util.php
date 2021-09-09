<?php

namespace ThomasDeLuck\CodeGenerator\Helpers;

class Util
{
    /**
     * Generate thumbnail from source.
     *
     * @param string $source
     * @param string $destination
     * @param int    $width
     * @param int    $height
     *
     * @return void
     */
    public static function generateThumbnail($source, $destination, $width = 160, $height = 160)
    {
        list($sourceWidth, $sourceHeight, $sourceType) = getimagesize($source);
        switch ($sourceType) {
            case IMAGETYPE_GIF:
                $sourceGD = @imagecreatefromgif($source);
                break;
            case IMAGETYPE_JPEG:
                $sourceGD = @imagecreatefromjpeg($source);
                break;
            case IMAGETYPE_PNG:
                $sourceGD = @imagecreatefrompng($source);
                break;
        }
        if (!isset($sourceGD) || $sourceGD === false) {
            return false;
        }
        $sourceAspectRatio = $sourceWidth / $sourceHeight;
        $thumbnailAspectRatio = $width / $height;
        if ($sourceWidth <= $width && $sourceHeight <= $height) {
            $thumbnailWidth = $sourceWidth;
            $height = $sourceHeight;
        } elseif ($thumbnailAspectRatio > $sourceAspectRatio) {
            $thumbnailWidth = (int) ($width * $sourceAspectRatio);
            $height = $height;
        } else {
            $thumbnailWidth = $width;
            $height = (int) ($height / $sourceAspectRatio);
        }
        $thumbnailGD = imagecreatetruecolor($thumbnailWidth, $height);
        switch ($sourceType) {
            case IMAGETYPE_GIF:
                imagecopyresampled($thumbnailGD, $sourceGD, 0, 0, 0, 0, $thumbnailWidth, $height, $sourceWidth, $sourceHeight);
                $background = imagecolorallocate($thumbnailGD, 0, 0, 0);
                imagecolortransparent($thumbnailGD, $background);
                @imagegif($thumbnailGD, $destination);
                break;
            case IMAGETYPE_JPEG:
                imagecopyresampled($thumbnailGD, $sourceGD, 0, 0, 0, 0, $thumbnailWidth, $height, $sourceWidth, $sourceHeight);
                @imagejpeg($thumbnailGD, $destination, 90);
                break;
            case IMAGETYPE_PNG:
                imagealphablending($thumbnailGD, false);
                imagesavealpha($thumbnailGD, true);
                imagecopyresampled($thumbnailGD, $sourceGD, 0, 0, 0, 0, $thumbnailWidth, $height, $sourceWidth, $sourceHeight);
                @imagepng($thumbnailGD, $destination);
                break;
        }
        imagedestroy($sourceGD);
        imagedestroy($thumbnailGD);

        return true;
    }

    /**
     * Parse HTML from url.
     *
     * @param string $url
     *
     * @return mixed
     */
    public static function parseHTML($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($curl);
        curl_close($curl);
        $dom = new \DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        return self::parseElement($dom->documentElement);
    }

    /**
     * Parse element from HTML.
     *
     * @param mixed $element
     *
     * @return mixed
     */
    public static function parseElement($element)
    {
        $obj = ['tag' => $element->tagName];
        foreach ($element->attributes as $attribute) {
            $obj[$attribute->name] = $attribute->value;
        }
        foreach ($element->childNodes as $subElement) {
            if ($subElement->nodeType == XML_TEXT_NODE) {
                $obj['content'] = trim($subElement->wholeText);
            } elseif ($subElement->nodeType == XML_CDATA_SECTION_NODE) {
                $obj['content'] = trim($subElement->data);
            } elseif ($subElement->nodeType == XML_ELEMENT_NODE) {
                $obj['children'][] = self::parseElement($subElement);
            }
        }

        return $obj;
    }

    /**
     * Get combinations array.
     *
     * @param mixed $arrays
     * @param int   $i
     *
     * @return array
     */
    public static function combinate($arrays, $i = 0)
    {
        if (!isset($arrays[$i])) {
            return [];
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = self::combinate($arrays, $i + 1);

        $result = [];

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ? array_merge([$v], $t) : [$v, $t];
            }
        }

        return $result;
    }
}
