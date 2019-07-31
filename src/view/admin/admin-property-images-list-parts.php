<?php
if ($val['ROOM_PHOTO'] == 0) {
    echo '<img src="../assets/images/properties/add_image.png" id="property_image_main_'.$key.'" name="property-image-main"  alt="写真を追加">
          <div class="sortImg" id="sort_key_'.$key.'">
          </div>';
} else {
    $files = glob($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/assets/images/properties/$key/*");
    if (count($files) > 0) {
        foreach ($files as $i => $fileName) {
            // ファイル名のみ抜き出して表示
            $fileName = "../" . substr($fileName, strpos($fileName, "assets/images/properties/$key"));
            if ($i == 0) {
                echo '<img src="' . $fileName . '" id="property_image_main_'.$key.'" name="property-image-main" alt="' . $val['PROPERTY_NAME'] . '_' . ($i + 1) . '">';
                echo '<div class="sortImg" id="sort_key_'.$key.'">
                      <div class="subimg">
                        <img src="' . $fileName . '" class="subimg saved" name="property-images-' . $key . '" alt="' . $val['PROPERTY_NAME'] . '_' . ($i + 1) . '">';
            } else {
                echo '<div class="subimg">
                        <img src="' . $fileName . '" class= "subimg saved" name="property-images-' . $key . '"  alt="' . $val['PROPERTY_NAME'] . '_' . ($i + 1) . '">';
            }
            echo '<input type="button" class="delbtn" name="delete-image-btn-'.$key.'" value="削除">
                  </div>';
        }
        echo "</div>";
    }
}
?>
<div class="image-upload-box">
<input type="file" id="upload_images_<? echo $key?>" name="upload-images[]" accept="image/*" multiple>
<input type="hidden" id="delete_image_path_<? echo $key ?>" name="delete-image-path" value="">
<input type="hidden" id="sort_image_path_<? echo $key ?>" name="sort-image-path" value="">
</div>
