<?php
echo "<div class='element-movie' onclick='movieDetail(".$linhas['id'].", $detailId, $type)'>
    <a href='/pages/detail.php?id=".$linhas['id']."&type=$type'>
      <img class='filme' id='".$linhas['id']."' src='".$linhas['caminho_img']."'/>
    </a>
  </div>
  ";
?>