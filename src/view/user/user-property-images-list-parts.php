<?php
if ($val['ROOM_PHOTO'] == 0) {
    echo '<img src="../assets/images/noimg.png" id="property_image_main_'.$key.'" name="property-image-main" class="mainimg" alt="写真を追加"><br>';
} else {
    $files = glob($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/assets/images/properties/$key/*");
    if (count($files) > 0) {
        foreach ($files as $i => $fileName) {
            // ファイル名のみ抜き出して表示
            $fileName = "../" . substr($fileName, strpos($fileName, "assets/images/properties/$key"));
            if ($i == 0) {
                echo '<img src="' . $fileName . '" id="property_image_main_'.$key.'" name="property-image-main" class="mainimg" alt="' . $val['PROPERTY_NAME'] . '_' . ($i + 1) . '"><br>';
                echo '<img src="' . $fileName . '" class="subimg" name="property-images-' . $key . '" class="subimage" alt="' . $val['PROPERTY_NAME'] . '_' . ($i + 1) . '">';
            } else {
                echo '<img src="' . $fileName . '" class= "subimg" name="property-images-' . $key . '" class="subimg" alt="' . $val['PROPERTY_NAME'] . '_' . ($i + 1) . '">';
            }
        }
    }
}
