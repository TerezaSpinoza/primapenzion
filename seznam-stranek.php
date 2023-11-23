<?php

require_once "./data.php";

//chci vypsat ul seznam

echo "<ul>";
  foreach ($poleStranek as $stranka) {
    echo "<li>
      <a href='?edit={$stranka->getId()}'>{$stranka->getId()}</a>
      </li>";
    }

echo "</ul>";
