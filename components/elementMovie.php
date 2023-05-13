<?php
echo "<div class='element-movie' onclick='movieDetail(".$linhas['id'].", $detailId, $type)'>
    <a href='/pages/detail.php?id=".$linhas['id']."&type=$type'>
      <img class='filme' id='".$linhas['id']."' src='https://image.tmdb.org/t/p/w220_and_h330_face".$linhas['caminho_img']."'/>
    </a>
  </div>
  ";
?>