<?php
class renamePropertyImage
{
    /*
     * 管理画面で画像を並び替えた際の、ファイル名をソートさせる処理。
     */
    public function sortImage(string $sortImages, string $pKey)
    {
        $sortImagesArr = explode(';', $sortImages);
        $renameDir = $_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/assets/images/properties/$pKey/";
        $errMsg = '';
        foreach ($sortImagesArr as $idx => $path) {
            if (!empty($path)) {
                $newIdx = "0".$idx."_";
                if (strlen($newIdx) > 3) {
                    $newIdx = substr($newIdx, 1);
                }
                $oldName = basename($path);

                if(preg_match('/^\d{2}_/',$oldName)) {
                    $newName = $newIdx.substr($oldName, 3);
                } else {
                    $newName = $newIdx.$oldName;
                }

                if (!rename(($renameDir.$oldName), ($renameDir.$newName))) {
                    $errMsg = "ファイルのソートに失敗しました<br>".$renameDir.$oldName."<br>→".$renameDir.$newName."<br><br>";
                    echo $errMsg;
                    return $errMsg;
                }
            }
        }
    }
}
